<?php

namespace App\Http\Livewire;

use App\Services\TwitterApi;
use Livewire\Component;

class SocialNetworks extends Component
{



    public $twitterName;
    public $twitterImgUri;
    public $twitterUsername;

    public function mount(TwitterApi $api)
    {
        $twitterUser = $api->userMe();

        if ($twitterUser) {
            $this->twitterName = $twitterUser->name;
            $this->twitterImgUri = $twitterUser->profile_image_url;
            $this->twitterUsername = $twitterUser->username;
        }
    }



    public function twitterLogin(TwitterApi $api)

    {
        return redirect()->to($api->oauthUri);
    }

    public function render()
    {
        return view('livewire.social-networks');
    }
}
