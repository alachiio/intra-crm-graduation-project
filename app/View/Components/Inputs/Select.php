<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Select extends Component
{
    public string $form;
    public string $name;
    public string $label;
    public bool $placeholder;
    public bool $validate;
    public mixed $options;
    public bool $multiple;
    public string $mode;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $placeholder = false, $validate = false, $options = [], $form = '', $prefix = 'props', $multiple = false, $mode = 'defer')
    {
        if ($prefix != '')
            $this->name = $prefix . '.' . $name;
        else
            $this->name = $name;
        $this->form = $form;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->validate = $validate;
        $this->options = $options;
        $this->multiple = $multiple;
        $this->mode = $mode;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.select');
    }
}
