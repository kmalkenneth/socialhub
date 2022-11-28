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
use App\Http\Controllers\TwitterController;
use Illuminate\Support\Facades\DB;

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





Route::controller(TwitterController::class)->group(function () {
    Route::get('/twitter/callback',  'callback')->name('twitter.callback');
    Route::get('/twitter/refresh', 'refresh')->name('twitter.refresh');
    Route::post('/twitter/revoke', 'revoke')->name('twitter.revoke');
});
