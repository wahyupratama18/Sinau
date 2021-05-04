<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;

class SiswaOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            !Student::where('user_id', $request->user()->id)
            ->where('active', 1)->first()
        ) 
            return redirect()->route('dashboard')->with([
                'status' => 'error',
                'message' => 'Anda tidak memiliki hak akses'
            ]);
        
        return $next($request);
    }
}
