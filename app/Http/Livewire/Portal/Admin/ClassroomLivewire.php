<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\{Classroom, ClassroomHistory, Department, Teacher, Year};
use App\Traits\StudentTraits;
use Illuminate\Validation\Rule;
use Livewire\{Component, WithPagination};

class ClassroomLivewire extends Component
{
    use StudentTraits, WithPagination;

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
     * Class Types
     * @var array $types
    */
    $types = ['X', 'XI', 'XII'],
    
    /**
     * Class Level (ORI)
     * @var string $level
    */
    $level,

    /**
     * Department ID
     * @var int $department
    */
    $department,

    /**
     * Class Group (Rombel)
     * @var int $group
    */
    $group,
    
    /**
     * Pilih Kelas
     * @var int $yearSelection
    */
    $yearSelection,
    
    /**
     * Students
     * @var array $students
    */
    $students,
    
    /**
     * Classroom ID
     * @var int $classID
    */
    $classID,
    
    /**
     * New Teacher
     * @var int $teacher
    */
    $teacher,
    
    /**
     * Current Teacher
     * @var string|null $currentTeacher
    */
    $currentTeacher = null,
    
    $history;


    /**
     * Render Component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function render()
    {
        $search = $this->search;

        if (is_numeric($this->yearSelection) && $this->classID) {

            $this->getHistory($this->yearSelection, $this->classID);
            $this->currentTeacher = $this->history->teacher->user->name ?? "Tidak ada data";
            $id = $this->history->id;

        }

        $kelas = Classroom::whereHas('department', function($q) use ($search) {
            if ($search) return $q
            ->where('long', 'like', "%$search%'")
            ->orWhere('abbr', 'like', "%$search%'");
        });

        if ($search) 
            $kelas->where('level', 'like', "%$search%'")
            ->orWhere('group', 'like', "%$search%'");

        return view('livewire.portal.admin.classroom-livewire', [
            'kelas' => $kelas->paginate($this->paginate),
            'dept' => Department::all(),
            'years' => Year::orderByDesc('end')->get(),
            'siswa' => isset($id) ? $this->finder($search)
            ->whereHas('classroom.history', function($q) use ($id) {
                return $q->where('id', $id);
            })->paginate($this->paginate) : [],
            'teach' => Teacher::with('user')->get()
        ]);
    }

    /**
     * Dynamic Rules
     * @return (string|(string|\Illuminate\Validation\Rules\Unique)[])[]
    */
    protected function rules() {
        return [
            'level' => ['required', Rule::in($this->types)],
            'department' => ['required','integer', Rule::exists(Department::class, 'id')],
            'group' => 'required|integer'
        ];
    }

    /**
     * Save
     * @return void
    */
    public function save()
    {
        $this->validate();
        Classroom::updateOrCreate([
            'level' => $this->level,
            'department_id' => $this->department,
            'group' => $this->group
        ]);

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
        $cls = Classroom::find($id);

        $this->classID = $id;
        $this->level = $cls->level ?? null;
        $this->department = $cls->department ?? null;
        $this->group = $cls->group ?? null;
    }

    /**
     * Destroy
     * @param int $id
     * @return void
    */
    public function destroy(int $id)
    {
        Classroom::find($id)->delete();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah terhapus'
        ]);
    }

    /**
     * Get Classroom History ID
     * @param int $year
     * @param int $class
     * @return void
    */
    private function getHistory(int $year, int $class)
    {
        $this->history = ClassroomHistory::updateOrCreate(['year_id' => $year, 'classroom_id' => $class]);
    }


    /**
     * Set Wali Kelas
    */
    public function setWali()
    {
        $this->validate([
            'teacher' => ['required', Rule::exists(Teacher::class, 'id')]
        ]);

        $this->history->teacher_id = $this->teacher;
        $this->history->save();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah tersimpan'
        ]);
    }
}
