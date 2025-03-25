<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public string $type;
    public string $name;
    public ?string $label;
    public string $placeholder;
    public bool $required;

    public function __construct(
        string $name,
        string $type = 'text',
        ?string $label = null,
        string $placeholder = '',
        bool $required = false
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.form.input');
    }
}
