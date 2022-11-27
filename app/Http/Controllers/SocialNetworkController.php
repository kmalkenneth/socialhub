<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class SocialNetworkController extends Controller
{
    /**
     * Store a new Social Network in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => [new Enum(Brand::class)],
            'acces_token' => 'required',
            'refresh_token' => 'required',
        ]);

        $socialNetwork = new SocialNetwork;
        $socialNetwork->user_id = Auth::user()->id;
        $socialNetwork->brand = $request->brand;
        $socialNetwork->acces_token = $request->acces_token;
        $socialNetwork->refresh_token = $request->refresh_token;


        $socialNetwork->save();
    }
}
