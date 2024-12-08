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
    public $value;
    public $icon;
    public $iconText;

    /**
     * Create a new component instance.
     */
    public function __construct($id = "", $name = "", $label = "", $placeholder = "", $type = "text", $value = '', $icon = null, $iconText = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->value = $value;
        $this->icon = $icon;
        $this->iconText = $iconText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-input');
    }
}
