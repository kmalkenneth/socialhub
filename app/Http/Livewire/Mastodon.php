<?php

namespace App\Http\Livewire;

use App\Services\MastodonApi;
use Livewire\Component;

class Mastodon extends Component
{

    public $login;
    public $text;

    protected $rules = [
        'text' => 'required|min:6',
    ];

    public function mount(MastodonApi $api)
    {
        $this->login = $api->Token();
    }

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function twitterLogin(MastodonApi $api)

    {
        return redirect()->to($api->oauthUri);
    }

    public function tweets(MastodonApi $api)
    {
        $validatedData = $this->validate();
        $responce = $api->statuses($validatedData['text']);
        if ($responce) {
            $this->text = '';
        }
    }

    public function render()
    {
        return view('livewire.mastodon');
    }
}
