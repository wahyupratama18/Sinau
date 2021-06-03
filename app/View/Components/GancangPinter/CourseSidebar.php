<?php

namespace App\View\Components\GancangPinter;

use App\Models\EnrollClassroom;
use Illuminate\View\Component;

class CourseSidebar extends Component
{

    /**
     * Course
    */
    public $course;


    /**
     * Create a new component instance.
     * @param \App\Models\EnrollClassroom $course
     * @return void
     */
    public function __construct(EnrollClassroom $course)
    {
        $this->course = $course;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.gancang-pinter.course-sidebar');
    }
}
