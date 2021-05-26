<?php

namespace App\Http\Livewire\Portal\Admin;

use App\Models\Course;
use Livewire\{Component, WithPagination};

class CourseLivewire extends Component
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
     * Course Name
     * @var string|null $name
    */
    $name,

    /**
     * Course Abbreviation
     * @var string|null $abbr
    */
    $abbr,
    
    /**
     * Course Description
     * @var string|null $description
    */
    $description,
    
    /**
     * Course ID
     * @var int $courseID
    */
    $courseID;

    /**
     * Render Component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function render()
    {
        return view('livewire.portal.admin.course-livewire', [
            'course' => Course::where('abbr', 'like', "%$this->search%")
            ->where('name', 'like', "%$this->search")->paginate($this->paginate)
        ]);
    }

    /**
     * Dynamic Rules
     * @return (string|(string|\Illuminate\Validation\Rules\Unique)[])[]
    */
    protected function rules() {
        return [
            'name' => 'required|string',
            'abbr' => 'required|string',
            'description' => 'required|string'
        ];
    }

    /**
     * Save
     * @return void
    */
    public function save()
    {
        $this->validate();

        Course::updateOrCreate(
            ['id' => $this->courseID],
            [
                'name' => $this->name,
                'abbr' => $this->abbr,
                'description' => $this->description
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
        $course = Course::find($id);

        $this->courseID = $id;
        $this->name = $course->name ?? null;
        $this->abbr = $course->abbr ?? null;
        $this->description = $course->description ?? null;
    }

    /**
     * Destroy
     * @param int $id
     * @return void
    */
    public function destroy(int $id)
    {
        Course::findOrFail($id)->delete();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Data telah terhapus'
        ]);
    }
}
