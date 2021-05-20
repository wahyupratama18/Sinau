<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\{Semester, Year};
use Illuminate\Validation\Rule;
use Livewire\{Component, WithPagination};

class SemesterLivewire extends Component
{

    use WithPagination;

    /**
     * Pagination
     * @var int $paginate
    */
    public $paginate = 5,
    
    /**
     * Mark
     * @var array $mark
    */
    $mark = ['ganjil', 'genap', 'antara'],
    
    /**
     * Year
     * @var int $year
    */
    $year,
    
    /**
     * Remarks
     * @var mixed remarks
    */
    $remarks;
    
    /**
     * Render Component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function render()
    {
        return view('livewire.portal.admin.semester-livewire', [
            'semester' => Semester::with('year')->orderByDesc('year_id')->paginate($this->paginate),
            'year' => Year::all()
        ]);
    }

    /**
     * Dynamic Rules
     * @return (string|(string|\Illuminate\Validation\Rules\Unique)[])[]
    */
    protected function rules() {
        return [
            'year' => 'required|integer',
            'remarks' => ['required', Rule::in($this->mark)]
        ];
    }


    /**
     * Save
     * @return void
    */
    public function save()
    {
        $this->validate();

        Semester::updateOrCreate(
            ['year_id' => $this->year, 'remarks' => $this->remarks],
            ['year_id' => $this->year]
        );

        $this->emit('saved');

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah tersimpan'
        ]);

    }


    /**
     * Set Active
     * @param int $id
     * @return void
    */
    public function setActive(int $id)
    {
        Semester::where('active', 1)->update(['active' => 0]);
        Semester::find($id)->update(['active' => 1]);
    }


    /**
     * SetID
     * @param int|null $id
     * @return void
    */
    public function setID(int $id = null)
    {
        $sem = Semester::find($id);
        $this->year = $sem->year_id ?? null;
        $this->remarks = $sem->remarks ?? null;
    }

}
