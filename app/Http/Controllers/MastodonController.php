<?php

namespace App\Http\Controllers;

use App\Services\MastodonApi;
use Illuminate\Http\Request;

class MastodonController extends Controller
{
    public function callback(Request $request, MastodonApi $api)
    {
        $validated = $request->validate([
            'code' => 'required',
        ]);

        $api->callback($request->code);

        return back();
    }

    public function revoke(MastodonApi $api)
    {
        if ($api->revoke()) {
            return back();
        }

        return back()->with('Could not sign out.');
    }
}
