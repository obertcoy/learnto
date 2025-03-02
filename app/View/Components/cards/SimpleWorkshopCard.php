<?php

namespace App\View\Components\cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SimpleWorkshopCard extends Component
{

    public $workshop;
    /**
     * Create a new component instance.
     */
    public function __construct($workshop)
    {
        $this->workshop = $workshop;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.simple-workshop-card');
    }
}
