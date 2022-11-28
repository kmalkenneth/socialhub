<?php

namespace App\Services;

use App\Models\Twitter;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Nette\Utils\Strings;

class TwitterApi
{
    protected $url;
    protected $http;

    public $oauthUri;

    public function __construct()
    {
        $this->url = 'https://api.twitter.com/2/';
        $this->http = Http::baseUrl($this->url);
        $this->oauthUri = "https://twitter.com/i/oauth2/authorize?response_type=code&client_id="
            . env("TWITTER_CLIENT_ID")
            . "&redirect_uri="
            . route('twitter.callback')
            . "&scope=tweet.write tweet.read users.read follows.read offline.access&state=state&code_challenge=challenge&code_challenge_method=plain";
    }

    public  function Token()
    {
        return  Twitter::where('user_id', '=', Auth::user()->id)->first();
    }


    public function callback(String $code)
    {

        $response = $this->http
            ->withBasicAuth(env('TWITTER_CLIENT_ID'), env('TWITTER_CLIENT_SECRET'))
            ->asForm()->post('/oauth2/token', [
                'code' => $code,
                'grant_type' => 'authorization_code',
                'client_id' => env('TWITTER_CLIENT_ID'),
                'redirect_uri' => route("twitter.callback"),
                'code_verifier' => 'challenge'
            ]);

        if ($response->successful()) {

            $body = json_decode($response->body());

            $token = $body->access_token;
            $refreshToken = $body->refresh_token;
            $expiresIn = $body->expires_in;

            $socialNetwork = new Twitter();
            $socialNetwork->user_id = Auth::user()->id;
            $socialNetwork->acces_token = $token;
            $socialNetwork->refresh_token = $refreshToken;
            $socialNetwork->expires_in = now()->addSeconds($expiresIn);

            $socialNetwork->save();
        }
    }

    private function refresh()
    {

        $token = $this->Token();

        $response = $this->http
            ->withBasicAuth(env('TWITTER_CLIENT_ID'), env('TWITTER_CLIENT_SECRET'))
            ->asForm()->post('/oauth2/token', [
                'refresh_token' => $token->refresh_token,
                'grant_type' => 'refresh_token',
                'client_id' => env('TWITTER_CLIENT_ID'),
            ]);

        if ($response->successful()) {

            $body = json_decode($response->body());

            $token->acces_token = $body->access_token;
            $token->refresh_token = $body->refresh_token;
            $token->expires_in = now()->addSeconds($body->expires_in);

            $token->save();

            return $token;
        }
    }

    public function revoke()
    {
        $response = $this->http
            ->withBasicAuth(env('TWITTER_CLIENT_ID'), env('TWITTER_CLIENT_SECRET'))
            ->asForm()->post('/oauth2/revoke', [
                'token' => $this->token()->acces_token,
                'client_id' => env('TWITTER_CLIENT_ID'),
                'token_type_hint' => 'access_token',
            ]);

        if ($response->successful()) {
            $token = $this->token();
            $token->delete();

            return true;
        }

        return false;
    }

    public function userMe()
    {
        $token = $this->token();

        if ($token) {

            if (now()->gte($token->expires_in)) {
                $this->refresh();
            }

            $response = $this->http
                ->withToken($token->acces_token)
                ->get('/users/me', [
                    'user.fields' => 'profile_image_url',
                ]);

            if ($response->successful()) {
                $body = json_decode($response);
                return $body->data;
            }
        }

        return null;
    }

    public function tweets(string $text)
    {
        $token = $this->token();

        if ($token) {

            if (now()->gte($token->expires_in)) {
                $token = $this->refresh();
            }


            $response = $this->http
                ->contentType('application/json')
                ->withToken($token->acces_token)

                ->post('/tweets', ['text' => $text]);


            // return dd($text);
            if ($response->successful()) {
                $body = json_decode($response);
                return $body->data;
            }
        }

        return null;
    }
}
