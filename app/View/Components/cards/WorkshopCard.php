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
        $this->workshop = $workshop->load('users'); // Eager load users relationship
        $user = Auth::user(); // Retrieve the currently authenticated user

        $this->hasJoined = $user ? $workshop->users->contains($user) : false;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.workshop-card');
    }
}
