<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Avatar extends Component
{
    /**
     * Create a new component instance.
     */
    public $src;
    public $alt;
    public $size;
    public $fallback;

    public function __construct($src = null, $alt = '', $size = 'h-10 w-10', $fallback = '')
    {
        $this->src = $src;
        $this->alt = $alt;
        $this->size = $size;
        $this->fallback = $fallback;
    }

    public function render()
    {
        return view('components.avatar');
    }
}
