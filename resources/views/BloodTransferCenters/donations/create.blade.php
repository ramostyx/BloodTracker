<x-app-layout>


    <div class="flex justify-start items-center gap-2">
        <div class="mt-6 flex flex-col justify-center items-center">
            <select class="promptDonor" type="text"></select>
        </div>
        <div class="mt-6 flex flex-col justify-center items-center">
            <x-input-label for="quantity" value="Quantity" class="sr-only"/>

            <x-text-input
                id="quantity"
                name="quantity"
                type="number"
                class="mt-1 block w-3/4"
                placeholder="Quantity Donated"
            />

        </div>
        <div class="mt-6  flex justify-end">
            <x-secondary-button
                class="flex justify-end"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'log-blood-donation')"
            >{{ __('Log a donation') }}</x-secondary-button>
        </div>
    </div>

    {{--modals--}}

    <x-modal name="log-blood-donation" maxWidth="xl" focusable>
        <form method="post" action="{{ route('bloodRequest.store') }}" >
            @csrf

            <div class="flex flex-wrap justify-center my-12">
                <div class="text-center ">
                    <h2 class="mb-3 text-xl font-medium text-gray-900">
                        {{ __('If the donor is new then log him/her in') }}
                    </h2>

                    <div class="flex flex-col gap-4 flex-wrap justify-center items-center">
                        <!-- Name -->
                        <div class="w-full">
                            <x-text-input placeholder="Full name" id="name"
                                          class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="name"
                                          :value="old('name')" required autofocus/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <!-- Email Address -->
                        <div class="w-full">
                            <x-text-input placeholder="Email" id="email"
                                          class="block mt-1 w-full rounded-full bg-gray-100" type="email" name="email"
                                          :value="old('email')" required/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <!-- Phone Number -->
                        <div class="w-full">
                            <x-text-input placeholder="Phone Number" id="phone"
                                          class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="phone"
                                          :value="old('phone')" required/>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button class="ml-3">
                            {{ __('Add') }}
                        </x-primary-button>
                    </div>

                </div>
            </div>

        </form>
    </x-modal>

    <x-slot name="scripts">

        <script>
            $(document).ready(function () {
                $(".promptDonor").select2({
                    placeholder: "Search donors",
                    minimumInputLength: 2,
                    width: '80%',
                    multiple: false,
                    ajax: {
                        url: "/donors", // route that returns a collection of clients
                        dataType: "json",
                        type: "GET",
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data.map(function (donor) {

                                    return {
                                        id: donor.id,
                                        text: donor.name
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
            });
        </script>

    </x-slot>


</x-app-layout>
