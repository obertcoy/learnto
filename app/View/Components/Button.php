<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $variant;
    public $size;

    /**
     * Create a new component instance.
     */
    public function __construct($variant = 'default', $size = 'default')
    {
        $this->variant = $variant;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.button');
    }
}
