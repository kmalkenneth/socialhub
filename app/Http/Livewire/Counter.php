<?php

namespace App\Http\Livewire;

use Atymic\Twitter\Facade\Twitter;
use Livewire\Component;

use Atymic\Twitter\Twitter as TwitterContract;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Counter extends Component
{
    public $count = 0;

    public function login()
    {

        $client =  new Client();

        $response = $client->post('https://api.twitter.com/2/oauth2/token', [
            RequestOptions::HEADERS => ['Accept' => 'application/json'],
            RequestOptions::AUTH => [env('TWITTER_CLIENT_KEY'), env('TWITTER_CLIENT_SECRET')],
            // RequestOptions::FORM_PARAMS => ['response_type' => ''],
        ]);



        return;
        dd(json_decode($response->getBody(), true));
    }

    public function increment()

    {

        $this->count++;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
