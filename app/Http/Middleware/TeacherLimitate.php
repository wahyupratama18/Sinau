<?php

namespace App\Http\Middleware;

use App\Models\Teacher;
use Closure;
use Illuminate\Http\Request;

class TeacherLimitate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {

        $teach = Teacher::where('user_id', $request->user()->id)
        ->with(['role' => function($q) use ($role) {
            if ($role) return $q->where('role', $role);
        }])->first();

        if (!$teach || $teach->role->isEmpty())
            return redirect()->route('dashboard')->with([
                'status' => 'error',
                'message' => 'Anda tidak memiliki hak akses'
            ]);

        return $next($request);
    }
}
