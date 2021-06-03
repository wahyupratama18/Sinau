<?php

namespace App\Http\Controllers\GancangPinter;

use App\Http\Controllers\Controller;
use App\Models\{Meet, Presence};
use App\Traits\EnrollTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetController extends Controller
{

    use EnrollTraits;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('teacher')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }


    /**
     * Update Or Create Data
     * @param \Illuminate\Http\Request $request
     * @param int|null $id
     * @return array
    */
    private function saved(Request $request, int $id = null)
    {
        $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'presence_opened' => 'nullable|date_format:H:i',
            'presence_closed' => 'nullable|date_format:H:i|after:presence_opened|required_with:presence_opened',
            'opened_at' => 'nullable|date',
            'closed_at' => 'nullable|date|after:opened_at'
        ]);
        
        Meet::updateOrCreate(
            ['id' => $id],
            [
                'enroll_classroom_id' => $request->enroll,
                'title' => $request->title,
                'date' => $request->date,
                'opened_at' => $request->opened_at,
                'closed_at' => $request->closed_at,
                'presence_opened' => $request->presence_opened,
                'presence_closed' => $request->presence_closed
            ]
        );

        return [
            'type' => 'success',
            'message' => 'Data berhasil disimpan'
        ];
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $enroll)
    {
        return view('sinau.enroll.form', [
            'course' => $this->getCourse($enroll),
            'route' => 'store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        return redirect()->route('enroll.show', ['enroll' => $request->enroll])
        ->with($this->saved($request));
    }

    /**
     * Display the specified resource.
     *
     * @param int $enroll
     * @param \App\Models\Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function show(int $enroll, $meet)
    {
        $data = [
            'course' => $this->getCourse($enroll)
        ];

        $met = Meet::where('enroll_classroom_id', $enroll)
        ->with('material');

        if ($student = Auth::user()->student->id ?? null) {
            $met->with('presensi', function($q) use ($student) {
                return $q->where('student_id', $student)->with('presence');
            });

            $data['meet'] = $met->findOrFail($meet);

            $now = now();
            $time = (object) [
                'open' => Carbon::parse($data['meet']->presence_opened),
                'close' => Carbon::parse($data['meet']->presence_closed)
            ];
            $data['form'] = false;

            if ($data['meet']->presence_opened && $now >= $time->open && $now <= $time->close && $data['meet']->presensi->isEmpty()) {
                $data['form'] = true;
                $data['presensi'] = $now > $time->open->addMinutes(10) ? Presence::where('id', '!=', 1)->get() : Presence::all();
            }

        } else $data['meet'] = $met->findOrFail($meet);

        return view('sinau.enroll.meets', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $enroll
     * @param  int  $meet
     * @return \Illuminate\Http\Response
     */
    public function edit($enroll, $meet)
    {
        return view('sinau.enroll.form', [
            'course' => $this->getCourse($enroll),
            'meet' => Meet::find($meet),
            'route' => 'update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $meet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $meet)
    {
        return redirect()->route('enroll.meet.show', ['enroll' => $request->enroll, 'meet' => $meet])
        ->with($this->saved($request, $meet));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Meet::findOrFail($id)->delete();

        return redirect()->route('enroll.show', ['enroll' => $request->enroll])
        ->with([
            'type' => 'success',
            'message' => 'Data berhasil terhapus'
        ]);
    }
}
