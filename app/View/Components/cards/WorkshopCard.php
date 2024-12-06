<?php

namespace App\View\Components\cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class WorkshopCard extends Component
{
public $workshop;
    public $hasJoined;

    /**
     * Create a new component instance.
     */
    public function __construct($workshop)
    {
        $this->workshop = $workshop;
        // $this->hasJoined = Auth::check() && $workshop->users()->contains(Auth::id());
        $this->hasJoined = false;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.workshop-card');
    }
}
