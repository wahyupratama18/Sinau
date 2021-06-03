<?php

namespace App\Http\Livewire\GancangPinter;

use App\Models\{Presence, PresenceMeet, Student};
use App\Traits\EnrollTraits;
use Illuminate\Http\Request;
use Livewire\Component;

class PresenceLivewire extends Component
{
    use EnrollTraits;

    public $enroll, $meet;

    public function mount($enroll, $meet)
    {
        $this->enroll = $enroll;
        $this->meet = $meet;
    }

    public function render()
    {
        $enroll = $this->enroll;
        $meet = $this->meet;

        return view('livewire.gancang-pinter.presence-livewire', [
            'course' => $this->getCourse($enroll),
            'meet' => $this->meet,
            'presensi' => Presence::all(),
            'student' => Student::where('active', 1)
            ->whereHas('classroom.history.rolls', function($q) use ($enroll) {
                return $q->where('id', $enroll);
            })
            ->with('user')
            ->with(['presensi' => function($q) use ($meet) {
                return $q->where('meet_id', $meet);
            }])->get()
        ])->layout('layouts.gancang-pinter.admin');
    }


    /**
     * Update Presensi
    */
    public function setPresent(int $presence, int $student)
    {
        PresenceMeet::updateOrCreate([
            'meet_id' => $this->meet,
            'student_id' => $student
        ], [
            'presence_id' => $presence,
            'remarks' => 'Disimpan guru'
        ]);

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah diperbarui'
        ]);
    }
}
