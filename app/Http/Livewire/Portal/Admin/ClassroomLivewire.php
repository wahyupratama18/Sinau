<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\{Classroom, Department};
use Illuminate\Validation\Rule;
use Livewire\{Component, WithPagination};

class ClassroomLivewire extends Component
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
    $group;


    /**
     * Render Component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function render()
    {
        $search = $this->search;
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
            'dept' => Department::all()
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
}
