<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public mixed $items;
    public string $title;

    /**
     * Create a new component instance.
     */
    public function __construct($title = '')
    {
        $this->title = $title;
        $this->items = explode('/', request()->path());
        if (request()->has('trashed'))
            $this->items [] = __('Trash');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumbs');
    }
}
