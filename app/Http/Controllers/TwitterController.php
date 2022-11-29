<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use App\Services\TwitterApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TwitterController extends Controller
{

    public function callback(Request $request, TwitterApi $api)
    {
        $validated = $request->validate([
            'code' => 'required',
        ]);

        $api->callback($request->code);

        return back();
    }

    public function revoke(TwitterApi $api)
    {
        if ($api->revoke()) {
            return back();
        }

        return back()->with('Could not sign out.');
    }


    public function tweets(Request $request, TwitterApi $api)
    {
        $validated = $request->validate([
            'text' => 'required',
        ]);

        return dd($request);
        $api->tweets($request->text);

        return back();
    }
}
