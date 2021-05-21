<?php

namespace App\View\Components\Select;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Single extends Component
{
    /**
     * UUID
     * @var mixed $id
    */
    public $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->id = Str::random(12);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select.single');
    }
}
