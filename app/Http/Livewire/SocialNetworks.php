<?php

namespace App\Http\Livewire;

use App\Http\Controllers\TwitterController;
use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SocialNetworks extends Component
{



    public $twitterName;
    public $twitterImgUri;
    public $twitterUsername;

    public function mount()
    {


        $twitterUser =
            app('App\Http\Controllers\TwitterController')->userMe();



        // dd($twitterUser);
        if ($twitterUser) {

            $this->twitterName = $twitterUser->name;
            $this->twitterImgUri = $twitterUser->profile_image_url;
            $this->twitterUsername = $twitterUser->username;
        }
    }



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
