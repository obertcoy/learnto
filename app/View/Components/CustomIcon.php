<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomIcon extends Component
{

    public $icon;
    public $size;

    /**
     * Create a new component instance.
     */
    public function __construct($icon, $size = 5)
    {
        $this->icon = $icon;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-icon');
    }
}
