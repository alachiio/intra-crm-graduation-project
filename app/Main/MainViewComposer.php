<?php

namespace App\Main;

use Illuminate\View\View;

class MainViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('pageName', \Helper::getPageName());
    }
}
