<?php

namespace App\Services;

use App\Models\Mastodon;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Nette\Utils\Strings;

class MastodonApi
{
    protected $url;
    protected $http;

    public $oauthUri;

    public function __construct()
    {
        $this->url = 'https://mastodon.social/';
        $this->http = Http::baseUrl($this->url);
        $this->oauthUri = $this->url
            . "oauth/authorize?response_type=code&client_id="
            . env("MASTODON_CLIENT_ID")
            . "&redirect_uri="
            . route("mastodon.callback")
            . "&scope=read read:accounts write follow";
    }

    public  function Token()
    {
        return  Mastodon::where('user_id', '=', Auth::user()->id)->first();
    }


    public function callback(String $code)
    {

        $response = $this->http
            ->withBasicAuth(env('MASTODON_CLIENT_ID'), env('MASTODON_CLIENT_SECRET'))
            ->asForm()->post('/oauth/token', [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'client_id' => env('MASTODON_CLIENT_ID'),
                'redirect_uri' => route("mastodon.callback"),
            ]);

        if ($response->successful()) {

            $body = json_decode($response->body());

            $token = $body->access_token;

            $socialNetwork = new Mastodon();
            $socialNetwork->user_id = Auth::user()->id;
            $socialNetwork->acces_token = $token;

            $socialNetwork->save();
        }
    }

    public function revoke()
    {
        $response = $this->http
            ->withBasicAuth(env('MASTODON_CLIENT_ID'), env('MASTODON_CLIENT_SECRET'))
            ->asForm()->post('/oauth/revoke', [
                'client_id' => env('MASTODON_CLIENT_ID'),
                'client_secret' => env('MASTODON_CLIENT_SECRET'),
                'token' => $this->token()->acces_token,
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

            $response = $this->http
                ->withToken($token->acces_token)
                ->get('api/v1/accounts/verify_credentials');

            if ($response->successful()) {
                $body = json_decode($response);
                return $body;
            }
        }

        return null;
    }

    public function statuses(string $text)
    {
        $token = $this->token();

        if ($token) {

            $response = $this->http
                ->contentType('application/json')
                ->withToken($token->acces_token)
                ->post('/api/v1/statuses', ['status' => $text]);


            // return dd($text);
            if ($response->successful()) {
                $body = json_decode($response);
                return $body;
            }
        }

        return null;
    }
}
