<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class LeadController extends ApiController
{
    public function __invoke()
    {
        $campaign = Campaign::where('reference_hash', request()->route('reference'))->first();
        $campaign->leads()->create([
            'name' => request('name'),
            'phone' => request('phone'),
            'email' => request('email'),
            'message' => request('message'),
        ]);
        $this->successResponse('success', null, 201);
    }
}
