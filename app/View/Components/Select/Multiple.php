<?php

namespace App\View\Components\Select;

use Illuminate\View\Component;

class Multiple extends Component
{
    /**
     * UUID
     * @var mixed $id
    */
    public $id,
    
    /**
     * API Search
     * @var mixed|null $search
    */
    $search = null;

    /**
     * Create a new component instance.
     * @param mixed|null $search
     * @return void
     */
    public function __construct($search=null)
    {
        $this->id = randText();
        $this->search = $search;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select.multiple');
    }
}
