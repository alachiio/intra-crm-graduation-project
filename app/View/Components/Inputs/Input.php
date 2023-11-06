<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $type;
    public string $label;
    public mixed $value;
    public bool $placeholder;
    public bool $validate;
    public string $mode;

    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($name, $label, $type = '', $value = '', $placeholder = false, $validate = false, $prefix = 'props', $mode = 'defer')
    {
        if ($prefix != '')
            $this->name = $prefix . '.' . $name;
        else
            $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->validate = $validate;
        $this->mode = $mode;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.input');
    }
}
