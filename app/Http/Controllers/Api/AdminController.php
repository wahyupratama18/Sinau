<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{
    Enroll
};
use App\Traits\StudentTraits;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    use StudentTraits;

    /**
     * Enrollment
     * @param \Illuminate\Http\Request $request
     * @return mixed
    */
    public function enroll(Request $request)
    {
        $s = $request->get('search');

        return Enroll::where('semester_id', $request->get('semester'))
        ->whereHas('course', function($q) use ($s)
        {
            return $q->where('abbr', 'like', "%$s%")
            ->orWhere('name', 'like', "%$s%");
        })->with('teacher')->get()->map(function($item) {
            return [
                'id' => $item->id,
                'text' => '('.$item->course->abbr.$item->course_increment.') '.$item->course->name.' - '.$item->teacher->user->name
            ];
        });
    }


    /**
     * Get Siswa By Year
     * @param \Illuminate\Http\Request $request
     * @return mixed
    */
    public function siswa(Request $request)
    {
        $year = $request->get('year');

        return $this->finder()
        ->whereDoesntHave('classroom.history', function($q) use ($year) {
            return $q->where('year_id', $year);
        })->get()->map(function($item) {
            return [
                'id' => $item->id,
                'text' => '('.$item->id.') '.$item->user->name
            ];
        });
    }

}
