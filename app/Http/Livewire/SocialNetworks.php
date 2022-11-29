<?php

namespace App\Http\Livewire;

use App\Services\MastodonApi;
use App\Services\TwitterApi;
use Livewire\Component;

class SocialNetworks extends Component
{



    public $twitterName;
    public $twitterImgUri;
    public $twitterUsername;

    public $mastodonName;
    public $mastodonImgUri;
    public $mastodonUsername;

    public function mount(TwitterApi $api, MastodonApi $mApi)
    {
        $twitterUser = $api->userMe();
        $MUser = $mApi->userMe();

        if ($twitterUser) {
            $this->twitterName = $twitterUser->name;
            $this->twitterImgUri = $twitterUser->profile_image_url;
            $this->twitterUsername = $twitterUser->username;
        }

        if ($MUser) {
            $this->mastodonName = $MUser->display_name;
            $this->mastodonImgUri = $MUser->avatar;
            $this->mastodonUsername = $MUser->username;
        }
    }



    public function twitterLogin(TwitterApi $api)
    {
        return redirect()->to($api->oauthUri);
    }

    public function mastodonLogin(MastodonApi $api)
    {
        return redirect()->to($api->oauthUri);
    }

    public function render()
    {
        return view('livewire.social-networks');
    }
}
