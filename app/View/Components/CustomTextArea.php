<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomTextArea extends Component
{
    public $id;
    public $name;
    public $label;
    public $placeholder;
    public $icon;
    public $value;

    /**
     * Create a new component instance.
     */
    public function __construct($id="", $name="", $label="", $placeholder="", $value="", $icon = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-text-area');
    }
}
