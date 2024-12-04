<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomInput extends Component
{

    public $id;
    public $name;
    public $label;
    public $placeholder;
    public $type;
    public $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($id="", $name="", $label="", $placeholder="", $type="text", $icon = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-input');
    }
}
