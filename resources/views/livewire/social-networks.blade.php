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
        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-t-md ">
            <div class="flex justify-center">

                <button class="btn gap-2" type="button" wire:click="twitterLogin" {{ $twitterName ? 'disabled' : '' }}>
                    <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M459.4 151.7c.325 4.548 .325 9.097 .325 13.65 0 138.7-105.6 298.6-298.6 298.6-59.45 0-114.7-17.22-161.1-47.11 8.447 .974 16.57 1.299 25.34 1.299 49.06 0 94.21-16.57 130.3-44.83-46.13-.975-84.79-31.19-98.11-72.77 6.498 .974 12.99 1.624 19.82 1.624 9.421 0 18.84-1.3 27.61-3.573-48.08-9.747-84.14-51.98-84.14-102.1v-1.299c13.97 7.797 30.21 12.67 47.43 13.32-28.26-18.84-46.78-51.01-46.78-87.39 0-19.49 5.197-37.36 14.29-52.95 51.65 63.67 129.3 105.3 216.4 109.8-1.624-7.797-2.599-15.92-2.599-24.04 0-57.83 46.78-104.9 104.9-104.9 30.21 0 57.5 12.67 76.67 33.14 23.72-4.548 46.46-13.32 66.6-25.34-7.798 24.37-24.37 44.83-46.13 57.83 21.12-2.273 41.58-8.122 60.43-16.24-14.29 20.79-32.16 39.31-52.63 54.25z">
                        </path>
                    </svg>
                    Twitter
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
            </div>
        </div>

        <div
            class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            Prueba
        </div>
    </div>
</div>
