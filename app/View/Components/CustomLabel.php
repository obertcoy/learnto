<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomLabel extends Component
{
    public $gap;
    /**
     * Create a new component instance.
     */
    public function __construct($gap = 2)
    {
        $this->gap = $gap;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-label');
    }
}
