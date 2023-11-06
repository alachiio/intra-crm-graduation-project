<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

class CustomEmailVerificationRequest extends EmailVerificationRequest
{
    public function authorize()
    {
        return parent::authorize();
    }
}
