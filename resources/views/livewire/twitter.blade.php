    <div>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Twitter') }}
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
                                            d="M459.4 151.7c.325 4.548 .325 9.097 .325 13.65 0 138.7-105.6 298.6-298.6 298.6-59.45 0-114.7-17.22-161.1-47.11 8.447 .974 16.57 1.299 25.34 1.299 49.06 0 94.21-16.57 130.3-44.83-46.13-.975-84.79-31.19-98.11-72.77 6.498 .974 12.99 1.624 19.82 1.624 9.421 0 18.84-1.3 27.61-3.573-48.08-9.747-84.14-51.98-84.14-102.1v-1.299c13.97 7.797 30.21 12.67 47.43 13.32-28.26-18.84-46.78-51.01-46.78-87.39 0-19.49 5.197-37.36 14.29-52.95 51.65 63.67 129.3 105.3 216.4 109.8-1.624-7.797-2.599-15.92-2.599-24.04 0-57.83 46.78-104.9 104.9-104.9 30.21 0 57.5 12.67 76.67 33.14 23.72-4.548 46.46-13.32 66.6-25.34-7.798 24.37-24.37 44.83-46.13 57.83 21.12-2.273 41.58-8.122 60.43-16.24-14.29 20.79-32.16 39.31-52.63 54.25z">
                                        </path>
                                    </svg>
                                    Twitter
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
                                        Tweet
                                    </button>
                                </fieldset>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
