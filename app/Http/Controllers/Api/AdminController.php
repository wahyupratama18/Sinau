<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{
    Enroll
};
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function enroll(Request $request)
    {
        $s = $request->get('search');

        return Enroll::where('semester_id', $request->get('semester'))
        ->whereHas('course', function($q) use ($s)
        {
            return $q->where('abbr', 'like', "%$s%")
            ->orWhere('name', 'like', "%$s%");
        })->with('teacher')->get()->map(function($item, $key) {
            return [
                'id' => $item->id,
                'text' => '('.$item->course->abbr.$item->course_increment.') '.$item->course->name.' - '.$item->teacher->user->name
            ];
        });
    }
}
