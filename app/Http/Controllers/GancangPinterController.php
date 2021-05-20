<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GancangPinterController extends Controller
{
    public function index()
    {
        if (Auth::check()) return view('sinau.index-admin');
        return view('sinau.index-guest');
    }


    /**
     * View About
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function about()
    {
        return view('sinau.about');
    }


    /**
     * View Guru
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function guru()
    {
        return view('sinau.guru');
    }
}
