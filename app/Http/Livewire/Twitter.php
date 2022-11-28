<?php

namespace App\Http\Livewire;

use App\Services\TwitterApi;
use Livewire\Component;

class Twitter extends Component
{


    public $login;
    public $text;

    protected $rules = [
        'text' => 'required|min:6',
    ];

    public function mount(TwitterApi $api)
    {
        $this->login = $api->Token();
    }

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function twitterLogin(TwitterApi $api)

    {
        return redirect()->to($api->oauthUri);
    }

    public function tweets(TwitterApi $api)
    {
        $validatedData = $this->validate();
        $responce = $api->tweets($validatedData['text']);
        if ($responce) {
            $this->text = '';
        }
    }

    public function render()
    {
        return view('livewire.twitter');
    }
}
