<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tables extends Component
{

    /**
     * Pagination Select
     * @var string|bool $paginate
    */
    public $paginate,

    /**
     * Search
     * @var string|bool $search
    */
    $search;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($paginate = 'paginate', $search = 'search')
    {
        $this->paginate = $paginate;
        $this->search = $search;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables');
    }
}
