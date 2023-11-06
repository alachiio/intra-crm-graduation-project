<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomEmailVerificationRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(CustomEmailVerificationRequest $request)
    {
        $user = $request->user();

        if (!hash_equals(sha1($user->getEmailForVerification()), (string)$request->route('hash'))) {
            return false;
        }

        if ($user->hasVerifiedEmail()) {
            return $this->redirect();
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->redirect();
    }

    private function redirect()
    {
        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }
}
