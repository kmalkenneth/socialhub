<div class='md:grid md:grid-cols-3 md:gap-6'>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">
                Social Networks
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                Link your social networks to be able to manage your content.
            </p>
        </div>

    </div>


    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md ">
            <div class="flex justify-center">

                <button class="btn gap-2 mr-2" type="button" wire:click="twitterLogin"
                    {{ $twitterName ? 'disabled' : '' }}>
                    <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M459.4 151.7c.325 4.548 .325 9.097 .325 13.65 0 138.7-105.6 298.6-298.6 298.6-59.45 0-114.7-17.22-161.1-47.11 8.447 .974 16.57 1.299 25.34 1.299 49.06 0 94.21-16.57 130.3-44.83-46.13-.975-84.79-31.19-98.11-72.77 6.498 .974 12.99 1.624 19.82 1.624 9.421 0 18.84-1.3 27.61-3.573-48.08-9.747-84.14-51.98-84.14-102.1v-1.299c13.97 7.797 30.21 12.67 47.43 13.32-28.26-18.84-46.78-51.01-46.78-87.39 0-19.49 5.197-37.36 14.29-52.95 51.65 63.67 129.3 105.3 216.4 109.8-1.624-7.797-2.599-15.92-2.599-24.04 0-57.83 46.78-104.9 104.9-104.9 30.21 0 57.5 12.67 76.67 33.14 23.72-4.548 46.46-13.32 66.6-25.34-7.798 24.37-24.37 44.83-46.13 57.83 21.12-2.273 41.58-8.122 60.43-16.24-14.29 20.79-32.16 39.31-52.63 54.25z">
                        </path>
                    </svg>
                    Twitter
                </button>

                <button class="btn gap-2" type="button" wire:click="mastodonLogin"
                    {{ $mastodonName ? 'disabled' : '' }}>
                    <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M480,173.59c0-104.13-68.26-134.65-68.26-134.65C377.3,23.15,318.2,16.5,256.8,16h-1.51c-61.4.5-120.46,7.15-154.88,22.94,0,0-68.27,30.52-68.27,134.65,0,23.85-.46,52.35.29,82.59C34.91,358,51.11,458.37,145.32,483.29c43.43,11.49,80.73,13.89,110.76,12.24,54.47-3,85-19.42,85-19.42l-1.79-39.5s-38.93,12.27-82.64,10.77c-43.31-1.48-89-4.67-96-57.81a108.44,108.44,0,0,1-1-14.9,558.91,558.91,0,0,0,96.39,12.85c32.95,1.51,63.84-1.93,95.22-5.67,60.18-7.18,112.58-44.24,119.16-78.09C480.84,250.42,480,173.59,480,173.59ZM399.46,307.75h-50V185.38c0-25.8-10.86-38.89-32.58-38.89-24,0-36.06,15.53-36.06,46.24v67H231.16v-67c0-30.71-12-46.24-36.06-46.24-21.72,0-32.58,13.09-32.58,38.89V307.75h-50V181.67q0-38.65,19.75-61.39c13.6-15.15,31.4-22.92,53.51-22.92,25.58,0,44.95,9.82,57.75,29.48L256,147.69l12.45-20.85c12.81-19.66,32.17-29.48,57.75-29.48,22.11,0,39.91,7.77,53.51,22.92Q399.5,143,399.46,181.67Z" />
                    </svg>
                    Mastodon
                </button>

            </div>


            <div class="flex mt-2">
                @if ($twitterName)
                    <div class="flex">
                        <div class="avatar">
                            <div class="w-12 rounded-xl mr-2">
                                <img src={{ $twitterImgUri }} />
                            </div>
                        </div>

                        <div class="mr-2">
                            <div class="text-lg font-extrabold">
                                {{ $twitterName }}
                            </div>

                            <div class="text-base-content/70 text-sm">{{ $twitterUsername }}</div>
                        </div>

                        <form name="revoke-twitter-form" id="revoke-twitter-form" method="post"
                            action="{{ route('twitter.revoke') }}">
                            @csrf
                            <input id="invisible_brand" name="brand" type="hidden" value="twitter">
                            <button aria-label="button component" class="btn btn-ghost btn-square" type="submit"
                                data-bcup-haslogintext="no">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>

                        </form>
                    </div>
                @endif

                @if ($mastodonName)
                    <div class="flex mr-2">
                        <div class="avatar">
                            <div class="w-12 rounded-xl mr-2">
                                <img src={{ $mastodonImgUri }} />
                            </div>
                        </div>

                        <div class="mr-2">
                            <div class="text-lg font-extrabold">
                                {{ $mastodonName }}
                            </div>

                            <div class="text-base-content/70 text-sm">{{ $mastodonUsername }}</div>
                        </div>

                        <form name="revoke-mastodon-form" id="revoke-mastodon-form" method="post"
                            action="{{ route('mastodon.revoke') }}">
                            @csrf
                            <button aria-label="button component" class="btn btn-ghost btn-square" type="submit"
                                data-bcup-haslogintext="no">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>

                        </form>
                    </div>
                @endif
            </div>
        </div>


    </div>
</div>
