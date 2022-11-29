    <div>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mastodon') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                @if (!$login)
                    <div class="hero min-h-screen bg-base-200 rounded-lg shadow border">
                        <div class="hero-content text-center">
                            <div class="max-w-md">
                                <h1 class="text-5xl font-bold">Hello there</h1>
                                <p class="py-6">
                                    It looks like you haven't linked your account yet.
                                    Nothing happens, just click on the button.
                                </p>

                                <button class="btn gap-2" type="button" wire:click="twitterLogin">
                                    <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false"
                                        data-prefix="fab" data-icon="twitter" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M480,173.59c0-104.13-68.26-134.65-68.26-134.65C377.3,23.15,318.2,16.5,256.8,16h-1.51c-61.4.5-120.46,7.15-154.88,22.94,0,0-68.27,30.52-68.27,134.65,0,23.85-.46,52.35.29,82.59C34.91,358,51.11,458.37,145.32,483.29c43.43,11.49,80.73,13.89,110.76,12.24,54.47-3,85-19.42,85-19.42l-1.79-39.5s-38.93,12.27-82.64,10.77c-43.31-1.48-89-4.67-96-57.81a108.44,108.44,0,0,1-1-14.9,558.91,558.91,0,0,0,96.39,12.85c32.95,1.51,63.84-1.93,95.22-5.67,60.18-7.18,112.58-44.24,119.16-78.09C480.84,250.42,480,173.59,480,173.59ZM399.46,307.75h-50V185.38c0-25.8-10.86-38.89-32.58-38.89-24,0-36.06,15.53-36.06,46.24v67H231.16v-67c0-30.71-12-46.24-36.06-46.24-21.72,0-32.58,13.09-32.58,38.89V307.75h-50V181.67q0-38.65,19.75-61.39c13.6-15.15,31.4-22.92,53.51-22.92,25.58,0,44.95,9.82,57.75,29.48L256,147.69l12.45-20.85c12.81-19.66,32.17-29.48,57.75-29.48,22.11,0,39.91,7.77,53.51,22.92Q399.5,143,399.46,181.67Z" />
                                    </svg>
                                    Mastodon
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card w-full bg-base-100 shadow-xl">
                        <div class="card-body">

                            <form name="twitter-post-form" id="twitter-post-form" wire:submit.prevent="tweets">

                                <fieldset class="mb-2">
                                    <textarea class="textarea textarea-bordered w-full mb-2" placeholder="what's going on?" name="text" id="text-tweet"
                                        wire:model="text"></textarea>
                                    @error('text')
                                        <div class="alert bg-base-100">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    class="stroke-current flex-shrink-0 w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                                <span>{{ $message }}</span>
                                            </div>
                                        </div>
                                    @enderror
                                </fieldset>

                                <fieldset class="flex justify-end">
                                    <button aria-label="button component" class="btn" type="submit"
                                        data-bcup-haslogintext="no">
                                        Post
                                    </button>
                                </fieldset>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
