<?php

namespace App\View\Components\GancangPinter;

use Illuminate\View\Component;

class Base extends Component
{
    /**
     * CSS Asset
     * @var string css
    */
    public $css,

    /**
     * Navbar Rule
     * @var mixed|null $navbar
    */
    $navbar;

    /**
     * Create a new component instance.
     *
     * @param string $css
     * @param mixed|null $navbar
     * @return void
     */
    public function __construct(string $css, $navbar = null)
    {
        $this->css = $css;
        // $this->navbar = $navbar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.gancang-pinter.base');
    }
}
