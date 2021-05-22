<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\TimeSchedule;
use Livewire\{Component, WithPagination};

class TimeLivewire extends Component
{
    use WithPagination;

    /**
     * Pagination
     * @var int $paginate
    */
    public $paginate = 5,
    
    /**
     * Day
     * @var int $day
    */
    $day = 1,

    /**
     * Table Sort Day
     * @var int $day
    */
    $tDay = 1,

    /**
     * Ordered
     * @var int $ordered
    */
    $ordered,
    
    /**
     * Time Start
     * @var date $time_start
    */
    $time_start,

    /**
     * Time ended
     * @var date $time_end
    */
    $time_end,
    
    /**
     * Time ID
     * @var int|null $timeID
    */
    $timeID = null;


    /**
     * Render Component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function render()
    {
        $time = new TimeSchedule();

        return view('livewire.portal.admin.time-livewire', [
            'times' => TimeSchedule::where('day', $this->tDay)
            ->orderBy('ordered')->paginate($this->paginate),
            'days' => $time->getAllDays()
        ]);
    }

    /**
     * Dynamic Rules
     * @return (string|(string|\Illuminate\Validation\Rules\Unique)[])[]
    */
    protected function rules() {
        return [
            'tDay' => 'required|integer|between:1,6',
            'ordered' => 'required|integer|between:1,20',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start'
        ];
    }

    /**
     * Save
     * @return void
    */
    public function save()
    {
        $this->validate();

        // Update Teacher Side
        TimeSchedule::updateOrCreate(
            ['day' => $this->tDay, 'ordered' => $this->ordered],
            ['time_start' => $this->time_start, 'time_end' => $this->time_end]
        );
        $this->timeID = null;

        // Trigger Save
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
        $this->timeID = $id;
        
        // Set All Of These
        $t = TimeSchedule::find($id);
        
        $this->tDay = $t->day ?? null;
        $this->ordered = $t->ordered ?? null;
        $this->time_start = $t->time_start ?? null;
        $this->time_end = $t->time_end ?? null;

    }
    
    /**
     * Destroy
     * @param int $id
     * @return void
    */
    public function destroy(int $id)
    {
        TimeSchedule::findOrFail($id)->delete();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah terhapus'
        ]);
    }
}
