<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomSelect extends Component
{
    public $id;
    public $name;
    public $label;
    public $placeholder;
    public $data;
    public $key;
    /**
     * Create a new component instance.
     */
    public function __construct($id = "", $name = "", $label = "", $placeholder = "", $data, $key)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->data = $data;
        $this->key = $key;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-select');
    }
}
