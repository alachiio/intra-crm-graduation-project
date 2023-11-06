<?php

namespace App\Http\Middleware;

use App\Enums\AccountStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->account_status != AccountStatusEnum::ACTIVE->value) {

            toast('warning', __('Your account is ' . AccountStatusEnum::from(auth()->user()->account_status)->diffForHumans()));

            request()->session()->invalidate();
            request()->session()->flush();

            Auth::logout();

            return redirect()->route('login');
        }
        return $next($request);
    }
}
