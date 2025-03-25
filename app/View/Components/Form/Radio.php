<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Radio extends Component
{
    public $name;
    public $label;
    public $options;
    public $required;

    public function __construct($name, $label, $options = [], $required = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.form.radio');
    }
}
