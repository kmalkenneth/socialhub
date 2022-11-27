<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SocialNetworks extends Component
{




    public function twitterLogin()

    {
        return redirect()->to(
            "https://twitter.com/i/oauth2/authorize?response_type=code&client_id="
                . env("TWITTER_CLIENT_ID")
                . "&redirect_uri="
                . route('twitter.callback')
                . "&scope=tweet.write tweet.read users.read follows.read offline.access&state=state&code_challenge=challenge&code_challenge_method=plain"
        );
    }

    public function render()
    {
        return view('livewire.social-networks');
    }
}
