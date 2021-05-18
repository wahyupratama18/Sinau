<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AssetPusher extends Component
{
    public $css, $js;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $css = [], array $js = []) {
        $this->css = $css;
        $this->js = $js;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.asset-pusher');
    }
}
