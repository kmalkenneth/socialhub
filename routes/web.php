<?php

use App\Http\Controllers\SocialNetworkController;
use App\Models\SocialNetwork;
use Atymic\Twitter\Facade\Twitter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Enums\BrandEnum;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::get('/twitter/callback', [static function () {
    $validated = request()->validate([
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
    // $expiresIn = $body->expiresIn;

    $socialNetwork = new SocialNetwork;
    $socialNetwork->user_id = Auth::user()->id;
    $socialNetwork->brand = 'twitter';
    $socialNetwork->acces_token = $token;
    $socialNetwork->refresh_token = $refreshToken;


    $socialNetwork->save();

    return redirect('/dashboard');
}])->name('twitter.callback');
