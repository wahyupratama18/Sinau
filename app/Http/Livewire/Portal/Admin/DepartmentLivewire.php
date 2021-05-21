<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\Department;
use Illuminate\Validation\Rule;
use Livewire\{Component, WithPagination};

class DepartmentLivewire extends Component
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
     * Department ID
     * @var int $deptID
    */
    $deptID,
    
    /**
     * Abbreviation (Singkatan)
     * @var mixed $abbr
    */
    $abbr,

    /**
     * Long Text
     * @var mixed $long
    */
    $long;


    /**
     * Render Component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function render()
    {
        return view('livewire.portal.admin.department-livewire', [
            'dept' => Department::where('abbr', 'like', "%$this->search%")
            ->orWhere('long', 'like', "%$this->search%")
            ->paginate($this->paginate)
        ]);
    }

    /**
     * Dynamic Rules
     * @return (string|(string|\Illuminate\Validation\Rules\Unique)[])[]
    */
    protected function rules() {
        return [
            'abbr' => 'required|string|max:10',
            'long' => ['required', 'string', Rule::unique(Department::class, 'long')->ignore($this->deptID)]
        ];
    }

    /**
     * Save
     * @return void
    */
    public function save()
    {
        $this->validate();

        Department::updateOrCreate(
            ['id' => $this->deptID],
            ['abbr' => $this->abbr, 'long' => $this->long]
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
        $dept = Department::find($id);

        $this->abbr = $dept->abbr ?? null;
        $this->long = $dept->long ?? null;
        $this->deptID = $id;
    }

    /**
     * Destroy
     * @param int $id
     * @return void
    */
    public function destroy(int $id)
    {
        Department::find($id)->delete();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah terhapus'
        ]);
    }

}
