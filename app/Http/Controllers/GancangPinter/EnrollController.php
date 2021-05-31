<?php

namespace App\Http\Controllers\GancangPinter;

use App\Http\Controllers\Controller;
use App\Models\EnrollClassroom;
use App\Traits\{
    EnrollTraits,
    SummernoteUpload
};

use Illuminate\Http\Request;


class EnrollController extends Controller
{

    use EnrollTraits, SummernoteUpload;

    /**
     * Display the specified resource.
     * @param int $enroll
     * @return \Illuminate\Http\Response
     */
    public function show(int $enroll)
    {

        return view('sinau.enroll.index', [
            'course' => $this->getCourse($enroll)
        ]);
    }


    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(int $enroll, Request $request)
    {
        $request->validate([ 'announcement' => 'required|string' ]);

        EnrollClassroom::findOrFail($enroll)
        ->update([
            'announcement' => $this->upload($request->announcement, 'images')
        ]);

        return redirect()->route('enroll.show', ['enroll' => $request->enroll]);

    }
}
