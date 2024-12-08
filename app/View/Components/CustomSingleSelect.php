<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomSingleSelect extends Component
{
    public $id;
    public $name;
    public $label;
    public $placeholder;
    public $data;
    public $valueKey;
    /**
     * Create a new component instance.
     */
    public function __construct($id = "", $name = "", $label = "", $placeholder = "", $data = null, $valueKey = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->data = $data ?? collect();
        $this->valueKey = $valueKey;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-single-select', [
            'data' => $this->data,
            'valueKey' => $this->valueKey,
        ]);
    }
}
