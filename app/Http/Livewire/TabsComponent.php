<?php

namespace App\Http\Livewire;

abstract class TabsComponent extends BaseComponent
{
    public $tabs;
    public $current = '';

    protected function setTabs($tabs)
    {
        $this->tabs = $tabs;
        $this->current = array_key_first($tabs);
    }

    public function changeTab($key)
    {
        $this->current = $key;
    }
}
