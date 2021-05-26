<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\{
    Classroom,
    ClassroomHistory,
    Enroll,
    EnrollClassroom,
    Semester
};
use Illuminate\Validation\Rule;
use Livewire\{Component, WithPagination};

class ScheduleLivewire extends Component
{

    use WithPagination;

    /**
     * Pagination
     * @var int $paginate
    */
    public $paginate = 5,

    /**
     * Search Query
     * @var mixed $search
    */
    $search = null,

    /**
     * Class Code
     * @var int $class_id
    */
    $class_id,
    
    /**
     * Semester ID
     * @var int $semester_id
    */
    $semester_id,
    
    /**
     * Selected Class
     * @var App\Models\ClassroomHistory $selectedClass
    */
    $selectedClass,
    
    /**
     * Enroll Classroom ID (For Jadwal)
     * @var int $enrollID
    */
    $enrollID,
    
    /**
     * Enroll ID Creation
     * @var int[] $enroll_id
    */
    $enroll_id;


    /**
     * Render Component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function render()
    {
        $sem = Semester::find($this->semester_id);

        if (
            $this->class_id && $this->semester_id &&
            (!$this->selectedClass ||
            $this->selectedClass->classroom_id != $this->class_id ||
            $this->selectedClass->year_id != $sem->year_id)
        ) {
            $this->selectedClass = ClassroomHistory::where('classroom_id', $this->class_id)
            ->where('year_id', $sem->year_id)->first();
        }


        return view('livewire.portal.admin.schedule-livewire', [
            'kelas' => Classroom::with('department')->get(),
            'semester' => Semester::with('year')->orderByDesc('active')
            ->orderByDesc('year_id')
            ->get(),
            'enrolls' => $this->selectedClass ?
            EnrollClassroom::where('classroom_history_id', $this->selectedClass->id)
            ->whereHas('enroll', function($q) use ($sem) {
                return $q
                ->with('course')
                ->with('teacher.user')
                ->where('semester_id', $sem->id);
            })->paginate($this->paginate)
            : []
        ]);
    }
    
    /**
     * Dynamic Rules
     * @return (string|(string|\Illuminate\Validation\Rules\Unique)[])[]
    */
    protected function rules() {
        return [
            'enroll_id' => 'required|array',
            'enroll_id.*' => ['required', Rule::exists(Enroll::class, 'id') ]
        ];
    }

    /**
     * Save
     * @return void
    */
    public function save()
    {
        $this->validate();

        foreach ($this->enroll_id as $key) {

            EnrollClassroom::create([
                'enroll_id' => $key,
                'classroom_history_id' => $this->selectedClass->id
            ]);

        }

        $this->emit('saved');

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah tersimpan'
        ]);
    }

    /**
     * SetID
     * @param int|null $id
     * @return void
    */
    public function setID(int $id=null)
    {
        $this->enrollID = $id;
    }

    
    /**
     * Destroy
     * @param int $id
     * @return void
    */
    public function destroy(int $id)
    {
        EnrollClassroom::findOrFail($id)->delete();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah terhapus'
        ]);
    }
}
