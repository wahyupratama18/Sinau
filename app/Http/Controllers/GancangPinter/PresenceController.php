<?php

namespace App\Http\Controllers\GancangPinter;

use App\Http\Controllers\Controller;
use App\Models\{Meet, Presence, PresenceMeet};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($meet, Request $request)
    {

        $request->validate([
            'presensi' => ['required', Rule::exists(Presence::class, 'id')]
        ]);

        $student = Auth::user()->student->id;

        $met = Meet::whereDoesntHave('presensi', function($q) use ($student) {
            return $q->where('student_id', $student);
        })->findOrFail($meet);

        $now = now();
        $time = (object) [
            'open' => Carbon::parse($met->presence_opened),
            'close' => Carbon::parse($met->presence_closed)
        ];

        if (
            $met->presence_opened &&
            $now >= $time->open &&
            $now <= $time->close &&
            !($now >= $time->open->addMinutes(10) && $request->presensi == 1)
        ) {
            PresenceMeet::create([
                'meet_id' => $request->meet,
                'presence_id' => $request->presensi,
                'student_id' => $student,
                'remarks' => 'Disimpan sendiri'
            ]);
        } else abort(404);

        return redirect()->route('enroll.meet.show', [
            'enroll' => $request->enroll,
            'meet' => $request->meet
        ]);
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
}
