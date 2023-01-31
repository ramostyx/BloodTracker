<x-guest-layout>

    <div class="max-w-full min-h-screen grid grid-cols-2 bg-red-50 ">
        <div class="max-w-fll flex flex-col justify-center items-center">
            <h2 class="text-4xl flex flex-col ml-12 font-bold self-start">
                Become a hero
                <span>today!</span>
            </h2>
            <div class="h-[50%] self-end">
                <img src="{{asset('/images/figures/signup.png')}}" class="object-scale-down h-full w-full">
            </div>
        </div>

        <!-- SignUp Form -->

        <div
            class="bg-white flex min-h-screen gap-2 flex-col justify-start items-center max-w-full px-8 py-4 rounded-l-3xl ">
            <a class="self-start" href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
            </a>
            <h2 class="text-4xl font-bold">
                Sign Up
            </h2>
            <div class="px-12">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-text-input placeholder="Full name" id="name"
                                      class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="name"
                                      :value="old('name')" required autofocus/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-text-input placeholder="Email" id="email" class="block mt-1 w-full rounded-full bg-gray-100"
                                      type="email" name="email" :value="old('email')" required/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-text-input placeholder="Phone Number" id="phone"
                                      class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="phone"
                                      :value="old('phone')" required/>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                    </div>

                    <!-- Address -->

                    <div class="grid grid-rows-2">
                        <div class="grid grid-cols-3 gap-2">
                            <!-- country -->
                            <div class="mt-4">
                                <x-text-input placeholder="Country" id="country"
                                              class="block mt-1 w-full rounded-full bg-gray-100" type="text"
                                              name="country" :value="old('country')" required/>
                                <x-input-error :messages="$errors->get('country')" class="mt-2"/>
                            </div>
                            <!-- city -->
                            <div class="mt-4">
                                <x-text-input placeholder="City" id="city"
                                              class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="city"
                                              :value="old('city')" required/>
                                <x-input-error :messages="$errors->get('city')" class="mt-2"/>
                            </div>
                            <!-- zipCode -->
                            <div class="mt-4">
                                <x-text-input placeholder="Zip code" id="zipCode"
                                              class="block mt-1 w-full rounded-full bg-gray-100" type="text"
                                              name="zipCode" :value="old('zipCode')" pattern="[0-9]{5}" required/>
                                <x-input-error :messages="$errors->get('zipCode')" class="mt-2"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <!-- province -->
                            <div class="mt-4">
                                <x-text-input placeholder="Province" id="province"
                                              class="block mt-1 w-full rounded-full bg-gray-100" type="text"
                                              name="province" :value="old('province')" required/>
                                <x-input-error :messages="$errors->get('province')" class="mt-2"/>
                            </div>
                            <!-- street -->
                            <div class="mt-4">
                                <x-text-input placeholder="Street" id="street"
                                              class="block mt-1 w-full rounded-full bg-gray-100" type="text"
                                              name="street" :value="old('street')" required/>
                                <x-input-error :messages="$errors->get('street')" class="mt-2"/>
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">

                        <x-text-input placeholder="Password" id="password"
                                      class="block mt-1 w-full rounded-full bg-gray-100"
                                      type="password"
                                      name="password"
                                      required autocomplete="new-password"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">

                        <x-text-input placeholder="Confirm password" id="password_confirmation"
                                      class="rounded-full bg-gray-100 block mt-1 w-full"
                                      type="password"
                                      name="password_confirmation" required/>

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                    </div>

                    <div class="flex flex-col gap-2 justify-center items-center mt-4">
                        <x-primary-button class="ml-4 ">
                            {{ __('Register') }}
                        </x-primary-button>
                        <div
                            class="text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{__('Already registered?')}}
                            <a class="underline text-blue-500 hover:text-gray-900" href="{{ route('login') }}">
                                {{ __('Login from here') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>


