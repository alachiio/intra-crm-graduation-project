<?php

namespace App\View\Components\Inputs;

class Cover extends ImageUpload
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.cover');
    }
}
