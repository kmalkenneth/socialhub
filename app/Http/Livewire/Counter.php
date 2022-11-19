<?php

namespace App\Http\Livewire;

use Atymic\Twitter\Facade\Twitter;
use Livewire\Component;

use Atymic\Twitter\Twitter as TwitterContract;
use Illuminate\Http\JsonResponse;



class Counter extends Component
{
    public $count = 0;

    public function login()
    {
        $result =

            dd($result);
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
