<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProfileAvatar extends Component
{
    /**
     * Create a new component instance.
     */
    public $user;
    public $src;
    public $alt;
    public $size;
    public $fallback;
    public $redirect;
    public $id;

    public function __construct($user, $size = 'h-10 w-10', $redirect=true, $id = '')
    {
        $this->user = $user;
        $this->src = $user->profile_picture_url;
        $this->alt = $user->name;
        $this->size = $size;
        $this->redirect = $redirect;
        $this->fallback = collect(explode(' ', $user->name))->map(fn($n) => strtoupper($n[0]))->join('');
        $this->id = $id;
    }

    public function render()
    {
        return view('components.profile-avatar');
    }
}
