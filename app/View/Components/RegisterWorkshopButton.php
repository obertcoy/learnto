<?php

namespace App\View\Components;

use App\Models\Workshop;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class RegisterWorkshopButton extends Component
{
    public $eligible;
    public $workshop;
    public $class;

    /**
     * Create a new component instance.
     */
    public function __construct(Workshop $workshop, $class = "")
    {
        $this->eligible = !$workshop->users->contains(Auth::user());
        $this->workshop = $workshop;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.register-workshop-button');
    }
}
