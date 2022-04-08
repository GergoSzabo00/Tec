<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $id;
    public $name;
    public $value;
    public $class;
    public $icon;
    public $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $name, $type = 'text', $class = null, $icon = null, $placeholder = null, $value = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->class = $class;
        $this->icon = $icon;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
