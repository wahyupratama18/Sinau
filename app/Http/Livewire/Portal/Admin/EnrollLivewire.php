<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\{Course, Enroll, Semester, Teacher};
use Illuminate\Validation\Rule;
use Livewire\{Component, WithPagination};

class EnrollLivewire extends Component
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
     * Teacher ID
     * @var int $teacherID
    */
    $teacherID,
    
    /**
     * Semester ID
     * @var int $semesterID
    */
    $semesterID,

    /**
     * Course ID
     * @var int $courseID
    */
    $courseID,
    
    /**
     * Course Increment
     * @var int $course_inc
    */
    $course_inc,
    
    /**
     * Enroll ID
     * @var int $enrollID
    */
    $enrollID;

    /**
     * Render Component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function render()
    {

        return view('livewire.portal.admin.enroll-livewire', [
            'enroll' => Enroll::where('teacher_id', $this->teacherID)
            ->where('semester_id', $this->semesterID)
            ->with('course')
            ->paginate($this->paginate),
            'teacher' => Teacher::with('user')->whereHas('role', function($q){
                return $q->where('role', 2);
            })->get(),
            'semester' => Semester::with('year')->orderByDesc('active')
            ->orderByDesc('year_id')
            ->get(),
            'course' => Course::all()
        ]);
    }

    /**
     * Dynamic Rules
     * @return (string|(string|\Illuminate\Validation\Rules\Unique)[])[]
    */
    protected function rules() {
        return [
            'semesterID' => [ 'required', Rule::exists(Semester::class, 'id')],
            'teacherID' => ['required', Rule::exists(Teacher::class, 'id')],
            'courseID' => ['required', Rule::exists(Course::class, 'id')],
            'course_inc' => 'required|integer|min:1'
        ];
    }

    /**
     * Save
     * @return void
    */
    public function save()
    {
        $this->validate();

        Enroll::updateOrCreate(
            ['id' => $this->enrollID],
            [
                'semester_id' => $this->semesterID,
                'course_id' => $this->courseID,
                'teacher_id' => $this->teacherID,
                'course_increment' => $this->course_inc
            ]
        );

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
    public function setID(int $id = null)
    {
        $enroll = Enroll::find($id);

        $this->enrollID = $id;
        $this->courseID = $enroll->course_id ?? null;
        $this->course_inc = $enroll->course_increment ?? null;

    }

    
    /**
     * Destroy
     * @param int $id
     * @return void
    */
    public function destroy(int $id)
    {
        Enroll::findOrFail($id)->delete();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah terhapus'
        ]);
    }
}
