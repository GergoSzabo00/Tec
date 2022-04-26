<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $id;
    public $name;
    public $value;
    public $label;
    public $errorMessage;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $name, $value, $label, $errorMessage)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->errorMessage = $errorMessage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.checkbox');
    }
}
