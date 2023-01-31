<x-guest-layout>

    <div class="max-w-full min-h-screen sm:grid sm:grid-cols-2 bg-red-50 ">
        <div class="max-w-full hidden sm:block relative flex flex-col justify-center items-end">
            <h2 class="text-4xl absolute left-5 top-20 ml-12 flex flex-col font-bold self-start">
                Welcome back
                <span>hero!</span>
            </h2>
            <div class="self-end absolute right-0 top-28">
                <img src="{{asset('/images/figures/login.png')}}" class="object-scale-down h-[80%]">
            </div>
        </div>

        <!-- Login Form -->

        <div class="bg-white min-h-screen flex gap-2 flex-col justify-start items-center max-w-full px-8 py-4 rounded-l-3xl ">
            <a class="self-start" href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <h2 class="text-4xl mt-12 font-bold">
                Login
            </h2>
            <div class="px-12 mt-8 flex flex-col gap-4 w-full">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-text-input placeholder="Email" id="email" class="block mt-1 w-full rounded-full bg-gray-100" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">

                        <x-text-input id="password" class="block mt-1 w-full rounded-full bg-gray-100"
                                      type="password"
                                      name="password"
                                      placeholder="Password"
                                      required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{--                <!-- Remember Me -->--}}
                    {{--                <div class="block mt-4">--}}
                    {{--                    <label for="remember_me" class="inline-flex items-center">--}}
                    {{--                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
                    {{--                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
                    {{--                    </label>--}}
                    {{--                </div>--}}


                    <div class="flex flex-col gap-2 justify-center items-center mt-4">
                        <x-primary-button class="ml-4 bg-red-500 rounded-full p-4 hover:text-red-600 hover:bg-red-50">
                            {{ __('Log in') }}
                        </x-primary-button>
                        <div class="text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{__("You don't have an account?")}}
                            <a class="underline text-blue-500 hover:text-gray-900" href="{{ route('register') }}">
                                {{ __('Sign up from here') }}
                            </a>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>


</x-guest-layout>
