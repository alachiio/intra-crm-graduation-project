<?php

namespace App\View\Components\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Phone extends Component
{
    public string $name;
    public string $placeholder;
    public array $countries;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->name = 'phone';
        $this->placeholder = __('Phone');
        $this->countries = [
            [
                'name' => 'Syria',
                'original_name' => 'سوريا',
                'code' => '963',
                'flag' => 'sy',
                'mask' => '999 999 999'
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inputs.phone');
    }
}
