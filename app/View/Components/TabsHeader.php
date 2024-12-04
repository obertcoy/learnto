<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TabsHeader extends Component
{

    public $currentValue;
    public $value;
    public $route;
    public $user;

    public function __construct($currentValue, $value, $route, $user = null)
    {
        $this->currentValue = $currentValue;
        $this->value = $value;
        $this->route = $route;
        $this->user = $user;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tabs-header');
    }
}
