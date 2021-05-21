<?php

namespace App\View\Components\GancangPinter;

use illuminate\Support\Str;
use Illuminate\View\Component;

class SideDrop extends Component
{

    /**
     * Title List
     * @var string $title
    */
    public $title,

    /**
     * Href Route
     * @var string|null $href
    */
    $href,

    /**
     * Submenus
     * @var array|null $sub
    */
    $sub;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, string $href = null, array $sub = [])
    {
        $this->title = $title;
        if ($sub) {
            $this->href = Str::uuid();
            $this->sub = $sub;
        } else $this->href = route($href);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.gancang-pinter.side-drop');
    }
}
