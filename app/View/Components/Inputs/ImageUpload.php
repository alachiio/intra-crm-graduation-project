<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class ImageUpload extends Component
{
    public string $name;
    public string $label;
    public bool $validate;
    public $image;
    public $crop;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = '', $image = '', $validate = false, $crop = true, $prefix = 'files')
    {
        if ($prefix != '')
            $this->name = $prefix . '.' . $name;
        else
            $this->name = $name;
        $this->label = $label;
        $this->image = $image;
        $this->validate = $validate;
        $this->crop = $crop;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.image-upload');
    }
}
