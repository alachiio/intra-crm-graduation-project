<?php

namespace App\Http\Controllers;

use App\Enums\AccountStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('pages.index');
    }
}
