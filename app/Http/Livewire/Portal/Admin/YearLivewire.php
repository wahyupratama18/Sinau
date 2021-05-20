<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\Year;
use Livewire\{Component, WithPagination};

class YearLivewire extends Component
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
     * Start
     * @var int $start
    */
    $start,

    /**
     * End
     * @var int $end
    */
    $end;

    /**
     * Render Component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function render()
    {
        return view('livewire.portal.admin.year-livewire', [
            'tahun' => Year::where('start', 'like', "%$this->search%")
            ->orWhere('end', 'like', "%$this->search%")
            ->paginate($this->paginate)
        ]);
    }

    /**
     * Dynamic Rules
     * @return (string|(string|\Illuminate\Validation\Rules\Unique)[])[]
    */
    protected function rules() {
        return [
            'start' => 'required|integer',
            'end' => 'required|integer|size:'.(1 + $this->start)
        ];
    }

    /**
     * Save
     * @return void
    */
    public function save()
    {
        $this->validate();
        Year::updateOrCreate(
            ['start' => $this->start, 'end' => $this->end]
        );

        $this->emit('saved');

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah tersimpan'
        ]);
    }


    /**
     * Set ID
     * @param int|null $id
     * @return void
    */
    public function setID(int $id = null)
    {
        $tahun = Year::find($id);
        $this->start = $tahun->start ?? null;
        $this->end = $tahun->end ?? null;
    }

}
