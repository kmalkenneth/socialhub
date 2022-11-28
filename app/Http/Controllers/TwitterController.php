<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TwitterController extends Controller
{

    public function callback(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required',
        ]);

        $response = Http::baseUrl('https://api.twitter.com/')->withHeaders([
            'Accept' => '*/*',
        ])
            ->withBasicAuth(env('TWITTER_CLIENT_ID'), env('TWITTER_CLIENT_SECRET'))
            ->asForm()->post('/2/oauth2/token', [
                'code' => request()->query('code'),
                'grant_type' => 'authorization_code',
                'client_id' => env('TWITTER_CLIENT_ID'),
                'redirect_uri' => route("twitter.callback"),
                'code_verifier' => 'challenge'
            ]);

        $body = json_decode($response->body());

        $token = $body->access_token;
        $refreshToken = $body->refresh_token;
        $expiresIn = $body->expires_in;

        $socialNetwork = new SocialNetwork();
        $socialNetwork->user_id = Auth::user()->id;
        $socialNetwork->brand = 'twitter';
        $socialNetwork->acces_token = $token;
        $socialNetwork->refresh_token = $refreshToken;
        $socialNetwork->expires_in = now()->addSeconds($expiresIn);


        $socialNetwork->save();

        return back();
    }


    public function refresh(Request $request)
    {

        $token = $this->Token();

        $response = Http::baseUrl('https://api.twitter.com/')->withHeaders([
            'Accept' => '*/*',
        ])
            ->withBasicAuth(env('TWITTER_CLIENT_ID'), env('TWITTER_CLIENT_SECRET'))
            ->asForm()->post('/2/oauth2/token', [
                'refresh_token' => $token->refresh_token,
                'grant_type' => 'refresh_token',
                'client_id' => env('TWITTER_CLIENT_ID'),
            ]);

        if ($response->successful()) {

            $body = json_decode($response->body());

            $token = $body->access_token;
            $refreshToken = $body->refresh_token;
            $expiresIn = $body->expires_in;


            $socialNetwork = new SocialNetwork;
            $socialNetwork->user_id = Auth::user()->id;
            $socialNetwork->brand = 'twitter';
            $socialNetwork->acces_token = $token;
            $socialNetwork->refresh_token = $refreshToken;
            $socialNetwork->expires_in = now()->addSeconds($expiresIn);


            $socialNetwork->save();
        }
    }


    public function revoke(Request $request)
    {

        $response = Http::baseUrl('https://api.twitter.com/')->withHeaders([
            'Accept' => '*/*',
        ])

            ->withBasicAuth(env('TWITTER_CLIENT_ID'), env('TWITTER_CLIENT_SECRET'))
            ->asForm()->post('/2/oauth2/revoke', [
                'token' => $this->token()->acces_token,
                'client_id' => env('TWITTER_CLIENT_ID'),
                'token_type_hint' => 'access_token',
            ]);

        if ($response->successful()) {

            $token = $this->token();

            $token->delete();

            return back();
        }


        return back()->with('Could not sign out.');
    }

    function Token()
    {
        return  SocialNetwork::where('user_id', '=', Auth::user()->id)->where('brand', 'twitter')->first();
    }


    public function userMe()
    {
        $token = $this->token();

        if ($token) {

            if (now()->gte($token->expires_in)) {
                $this->refresh(new Request());
            }

            $response = Http::baseUrl('https://api.twitter.com/')->withHeaders([
                'Accept' => '*/*',
            ])
                ->withToken($token->acces_token)
                ->get('2/users/me', [
                    'user.fields' => 'profile_image_url',
                ]);
            if ($response->successful()) {
                $body = json_decode($response);
                return $body->data;
            }
        } else {
            return null;
        }

        return  back()->with('Failed to get user.');
    }
}
