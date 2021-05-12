<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{
    /**
     * Main Link
     * @var string|null
    */
    public $href = null,
    
    /**
     * Main Icon
     * @var string
    */
    $icon,

    /**
     * Title
     * @var string
    */
    $title,
    
    /**
     * Sub menu
     * @var array|null
    */
    $subs = [];

    /**
     * Create a new component instance.
     * 
     * @param string $icon
     * @param string $title
     * @param string|null $href
     * @param array $subs
     * @return void
     */
    public function __construct(string $icon, string $title, string $href = null, array $subs = [])
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->href = $href;
        $this->subs = $subs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dropdown');
    }
}
