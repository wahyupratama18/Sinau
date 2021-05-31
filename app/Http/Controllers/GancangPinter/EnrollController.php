<?php

namespace App\Http\Controllers\GancangPinter;

use App\Http\Controllers\Controller;
use App\Models\EnrollClassroom;
use App\Traits\SummernoteUpload;

use Illuminate\Http\Request;


class EnrollController extends Controller
{

    use SummernoteUpload;

    private static function getCourse(int $enroll)
    {
        return EnrollClassroom::with(['enroll' => function ($q) {
            return $q->with('teacher.user')->with('course');
        }])->with('meet')->findOrFail($enroll);
    }

    /**
     * Display a listing of the resource.
     * @param int $enroll
     * @return \Illuminate\Http\Response
     */
    public function index(int $enroll)
    {

        return view('sinau.enroll.index', [
            'course' => $this->getCourse($enroll)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $enroll)
    {
        return view('sinau.enroll.create', [
            'course' => $this->getCourse($enroll)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Store Announcement
    */
    public function announcement(int $enroll, Request $request)
    {
        $request->validate([
            'announcement' => 'required|string'
        ]);

        EnrollClassroom::find($enroll)->update([
            'announcement' => $this->upload($request->announcement, 'images')
        ]);

        return redirect()->route('course.enroll', ['enroll' => $request->enroll]);

    }
}
