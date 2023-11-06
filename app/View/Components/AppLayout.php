<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public function __construct(
        public string $title = '',
        public array  $sidePanel = [],
        public bool   $hasSidePanel = true,
        public bool   $hasSidePanelToggle = true,
        public bool   $isSidebarOpen = false,
        public bool   $isHeaderBlur = true,
        public bool   $hasMinSidebar = false,
        public bool   $headerSticky = true,
    )
    {
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
