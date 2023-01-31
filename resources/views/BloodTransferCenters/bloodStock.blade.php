<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul class="nav nav-pills flex flex-col md:flex-row flex-wrap list-none pl-0 mb-4" id="pills-tab3"
                        role="tablist">
                        <li class="nav-item" role="presentation">
                            <button type="button" class="block active btn font-medium text-xs leading-tight uppercase rounded-t-xl  active:border-b
  active:bg-red-50
  active:border-red-500
  hover:border-b
  hover:bg-red-50
  hover:border-red-500 w-full md:w-auto px-6 py-3 my-2 md:mr-2 focus:outline-none focus:ring-0"
                                    id="pills-stock-level-tab3" data-bs-toggle="pill"
                                    data-bs-target="#pills-stock-level" role="tab" aria-controls="pills-stock-level"
                                    aria-selected="true">
                                Stock level
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="
  block
  btn
  font-medium
  text-xs
  leading-tight
  uppercase
  rounded-t-xl
  active:border-b
  active:bg-red-50
  active:border-red-500
  hover:border-b
  hover:bg-red-50
  hover:border-red-500
  w-full
  md:w-auto
  px-6
  py-3
  my-2
  md:mx-2
  focus:outline-none focus:ring-0
" id="pills-transactions-tab3" data-bs-toggle="pill" data-bs-target="#pills-transactions" role="tab"
                                    aria-controls="pills-transactions" aria-selected="false">
                                Transactions
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="

  block
  btn
  font-medium
  text-xs
  leading-tight
  uppercase
  rounded-t-xl
  active:border-b
  active:bg-red-50
  active:border-red-500
  hover:border-b
  hover:bg-red-50
  hover:border-red-500
  w-full
  md:w-auto
  px-6
  py-3
  my-2
  md:ml-2
  focus:outline-none focus:ring-0
" id="pills-blood-donation-history-tab3" data-bs-toggle="pill" data-bs-target="#pills-blood-donation-history" role="tab"
                                    aria-controls="pills-blood-donation-history" aria-selected="false">
                                Donations history
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="

  block
  btn
  font-medium
  text-xs
  leading-tight
  uppercase
  rounded-t-xl
  active:border-b
  active:bg-red-50
  active:border-red-500
  hover:border-b
  hover:bg-red-50
  hover:border-red-500
  w-full
  md:w-auto
  px-6
  py-3
  my-2
  md:ml-2
  focus:outline-none focus:ring-0
" id="pills-blood-request-history-tab3" data-bs-toggle="pill" data-bs-target="#pills-blood-request-history" role="tab"
                                    aria-controls="pills-blood-request-history" aria-selected="false">
                                Blood request history
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent3">
                        <div class="tab-pane fade show active" id="pills-stock-level" role="tabpanel"
                             aria-labelledby="pills-stock-level-tab3">
                            @foreach($levels as $level)
                                <div class="relative">
                                    <div class="absolute w-16 py-1.5 left-0">
                                        <img src="{{asset('/images/'.$level->bloodType.'Type.png')}}"
                                             class="object-scale-down"/>
                                    </div>

                                    <div
                                        class="ml-20 bg-white shadow-lg rounded-lg py-2 px-4 mb-2 flex flex-col justify-center items-center gap-4">
                                        <div class="w-full bg-gray-300 h-4 rounded-lg">
                                            <div class="bg-red-600 h-4 relative rounded-lg"
                                                 style="width: {{number_format(($level->positive['stock'] / $level->positive['capacity']) * 100,2)}}%">
                                                <div class="absolute right-2 text-xs font-bold">
                                                    {{$level->positive['stock']}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full bg-gray-300 h-4 rounded-lg">
                                            <div class="bg-red-600 h-4 relative rounded-lg"
                                                 style="width: {{number_format(($level->negative['stock']/$level->negative['capacity']) * 100,2)}}%">
                                                <div class="absolute right-2 text-xs font-bold">
                                                    {{$level->negative['stock']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="pills-transactions" role="tabpanel"
                             aria-labelledby="pills-transactions-tab3">
                            @foreach($transactions as $transaction)
                                <div class="bg-white max-w-5xl mx-auto overflow-hidden shadow-sm sm:rounded-lg mb-2">
                                    <div class="p-6 bg-white border-b border-gray-200">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body flex justify-between items-center">
                                                            <div class=" flex flex-col gap-1">
                                                                <span class="text-sm font-light">
                                                                    {{$transaction->date->translatedFormat('j F Y') }}
                                                                </span>
                                                                <span class="text-sm font-light">
                                                                    {{$transaction->date->translatedFormat('H:i') }}
                                                                </span>
                                                            </div>
                                                            <div
                                                                class="flex gap-1 justify-center items-center text-red-600">
                                                                <span>{{$transaction->operation}}</span>
                                                                <span>{{$transaction->quantity}}</span>
                                                                <x-blood-bag Type="{{$transaction->bloodType}}"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="pills-blood-request-history" role="tabpanel"
                             aria-labelledby="pills-blood-request-history-tab3">
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="">
                                            <x-dropdown align="left" width="48">
                                                <x-slot name="trigger">
                                                    <x-secondary-button class="flex justify-end">
                                                        {{ __('Log a Request') }}
                                                        <div class="ml-1">
                                                            <svg class="fill-current h-4 w-4"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                      clip-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                    </x-secondary-button>
                                                </x-slot>

                                                <x-slot name="content">
                                                    <x-dropdown-button x-data=""
                                                                       x-on:click.prevent="$dispatch('open-modal', 'log-blood-request-new')">
                                                        {{ __('New client') }}
                                                    </x-dropdown-button>
                                                    <x-dropdown-button x-data=""
                                                                       x-on:click.prevent="$dispatch('open-modal', 'log-blood-request-existing')">
                                                        {{ __('Existing client') }}
                                                    </x-dropdown-button>

                                                </x-slot>
                                            </x-dropdown>
                                            <table class="min-w-full">
                                                <thead class="bg-white border-b">
                                                <tr>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Client Name
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Request Date
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Blood Type
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Quantity
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($stocks as $stock)
                                                    @foreach($stock->requests as $client)
                                                        <tr class="bg-white border-b">
                                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{$client->name}}
                                                            </td>
                                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ date('Y-m-d', strtotime($client->pivot->created_at)) }}
                                                            </td>
                                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{$client->pivot->bloodType}}
                                                            </td>
                                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{$client->pivot->quantity}}
                                                            </td>
                                                            <td>
                                                                <div class="flex gap-2">
                                                                    <form action="{{route('bloodRequest.destroy',[$client->pivot->id])}}" method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button
                                                                            type="submit"
                                                                            class="inline-block px-6 py-2.5 bg-transparent text-red-600 font-medium text-xs leading-tight uppercase rounded hover:bg-red-100 focus:text-red-700 focus:bg-red-100 focus:outline-none focus:ring-0 active:bg-red-200 active:text-red-800 transition duration-300 ease-in-out">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-blood-donation-history" role="tabpanel"
                             aria-labelledby="pills-blood-donation-history-tab3">
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="">
                                            <x-dropdown align="left" width="48">
                                                <x-slot name="trigger">
                                                    <x-secondary-button class="flex justify-end">
                                                        {{ __('Log a donation') }}
                                                        <div class="ml-1">
                                                            <svg class="fill-current h-4 w-4"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                      clip-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                    </x-secondary-button>
                                                </x-slot>

                                                <x-slot name="content">
                                                    <x-dropdown-button x-data=""
                                                                       x-on:click.prevent="$dispatch('open-modal', 'log-blood-donation-new')">
                                                        {{ __('New donor') }}
                                                    </x-dropdown-button>
                                                    <x-dropdown-button x-data=""
                                                                       x-on:click.prevent="$dispatch('open-modal', 'log-blood-donation-existing')">
                                                        {{ __('Existing donor') }}
                                                    </x-dropdown-button>

                                                </x-slot>
                                            </x-dropdown>
                                            <table class="min-w-full">
                                                <thead class="bg-white border-b">
                                                <tr>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Donor Name
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Donation Date
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Blood Type
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Quantity
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($stocks as $stock)
                                                    @foreach($stock->donations->sortBy('pivot.created_at') as $donor)
                                                        <tr class="bg-white border-b ">
                                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{$donor->user->name}}
                                                            </td>
                                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ date('Y-m-d', strtotime($donor->pivot->created_at)) }}
                                                            </td>
                                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{$donor->bloodType}}
                                                            </td>
                                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{$donor->pivot->quantity}}
                                                            </td>
                                                            <td>
                                                                <div class="flex gap-2">
                                                                    <form action="{{route('bloodDonation.destroy',$donor->pivot->id)}}" method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button
                                                                            type="submit"
                                                                            class="inline-block px-6 py-2.5 bg-transparent text-red-600 font-medium text-xs leading-tight uppercase rounded hover:bg-red-100 focus:text-red-700 focus:bg-red-100 focus:outline-none focus:ring-0 active:bg-red-200 active:text-red-800 transition duration-300 ease-in-out">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--modals--}}

    <x-modal name="log-blood-donation-existing" maxWidth="xl" focusable>
        <form method="post" action="{{ route('donations.storeExisting') }}" class="p-6">
            @csrf


            <div class="mt-6 flex flex-col justify-center items-center">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Search donors list') }}
                </h2>

                <select class="promptDonor rounded-full" type="text"></select>
            </div>
            <div class="mt-6 flex flex-col justify-center items-center">

                <select name="bloodType" id="bloodType" class="rounded-full hidden bg-gray-100 active:border-red-500 outline-none focus:border-red-500 active:border-red-500 border-2">
                    <option disabled selected>Blood Type</option>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                    <option>O+</option>
                    <option>O-</option>
                </select>

            </div>

            <input type="hidden" id="donor_id" name="donor_id">
            <div class="mt-6  flex justify-end">
                <x-primary-button class="mr-6">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="log-blood-donation-new" maxWidth="2xl" focusable>
        <form method="POST" action="{{ route('donations.storeNew') }}" class="py-6 px-12 text-center">
            @csrf

            <h2 class="text-xl font-medium font-semibold text-gray-900 mb-4">
                {{ __('New donor application form') }}
            </h2>

            <!-- Name -->
            <div>
                <x-text-input placeholder="Full name" id="name" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-text-input placeholder="Email" id="email" class="block mt-1 w-full rounded-full bg-gray-100" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-text-input placeholder="Phone Number" id="phone" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="phone" :value="old('phone')" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Address -->

            <div class="grid grid-rows-2">
                <div class="grid grid-cols-3 gap-2">
                    <!-- country -->
                    <div class="mt-4">
                        <x-text-input placeholder="Country" id="country" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="country" :value="old('country')" required />
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>
                    <!-- city -->
                    <div class="mt-4">
                        <x-text-input placeholder="City" id="city" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="city" :value="old('city')" required />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>
                    <!-- zipCode -->
                    <div class="mt-4">
                        <x-text-input placeholder="Zip code" id="zipCode" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="zipCode" :value="old('zipCode')" pattern="[0-9]{5}"  required />
                        <x-input-error :messages="$errors->get('zipCode')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <!-- province -->
                    <div class="mt-4">
                        <x-text-input placeholder="Province" id="province" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="province" :value="old('province')" required />
                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                    </div>
                    <!-- street -->
                    <div class="mt-4">
                        <x-text-input placeholder="Street" id="street" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="street" :value="old('street')" required />
                        <x-input-error :messages="$errors->get('street')" class="mt-2" />
                    </div>
                </div>

                <!-- Blood Type -->
                <div class="mt-4 flex justify-start items-start">
                    <select name="bloodType" class="rounded-full bg-gray-100 active:border-red-500 outline-none focus:border-red-500 active:border-red-500 border-2">
                        <option disabled selected>Blood Type</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col gap-2 justify-end items-end mt-4">
                <x-primary-button class="ml-4 ">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
<x-modal name="log-blood-request-existing" maxWidth="xl" focusable>
        <form method="post" action="{{ route('requests.storeExisting') }}" class="p-6">
            @csrf


            <div class="mt-6 flex flex-col justify-center items-center">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Search clients list') }}
                </h2>

                <select class="promptClient rounded-full" type="text"></select>
            </div>
            <div class="mt-6 flex flex-col justify-center items-center">
                <!-- Quantity -->
                <div >
                    <x-text-input placeholder="Quantity" id="quantity" class="block mt-1 w-full rounded-full bg-gray-100" type="number" min="1" name="quantity" :value="old('quantity')" required />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                </div>

                <select name="bloodType" id="clientBloodType" class="rounded-full hidden bg-gray-100 active:border-red-500 outline-none focus:border-red-500 active:border-red-500 border-2">
                    <option disabled selected>Blood Type</option>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                    <option>O+</option>
                    <option>O-</option>
                </select>

            </div>

            <input type="hidden" id="donor_id" name="donor_id">
            <div class="mt-6  flex justify-end">
                <x-primary-button class="mr-6">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="log-blood-request-new" maxWidth="2xl" focusable>
        <form method="POST" action="{{ route('requests.storeNew') }}" class="py-6 px-12 text-center">
            @csrf

            <h2 class="text-xl font-medium font-semibold text-gray-900 mb-4">
                {{ __('New client application form') }}
            </h2>

            <!-- Name -->
            <div>
                <x-text-input placeholder="Full name" id="name" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-text-input placeholder="Email" id="email" class="block mt-1 w-full rounded-full bg-gray-100" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-text-input placeholder="Phone Number" id="phone" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="phone" :value="old('phone')" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Address -->

            <div class="grid grid-rows-2">
                <div class="grid grid-cols-3 gap-2">
                    <!-- country -->
                    <div class="mt-4">
                        <x-text-input placeholder="Country" id="country" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="country" :value="old('country')" required />
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>
                    <!-- city -->
                    <div class="mt-4">
                        <x-text-input placeholder="City" id="city" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="city" :value="old('city')" required />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>
                    <!-- zipCode -->
                    <div class="mt-4">
                        <x-text-input placeholder="Zip code" id="zipCode" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="zipCode" :value="old('zipCode')" pattern="[0-9]{5}"  required />
                        <x-input-error :messages="$errors->get('zipCode')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <!-- province -->
                    <div class="mt-4">
                        <x-text-input placeholder="Province" id="province" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="province" :value="old('province')" required />
                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                    </div>
                    <!-- street -->
                    <div class="mt-4">
                        <x-text-input placeholder="Street" id="street" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="street" :value="old('street')" required />
                        <x-input-error :messages="$errors->get('street')" class="mt-2" />
                    </div>
                </div>


                <div class="mt-4 flex justify-start gap-2 items-start">
                    <!-- Quantity -->
                    <div class="">
                        <x-text-input placeholder="Quantity" id="quantity" class="block mt-1 w-full rounded-full bg-gray-100" type="number" min="1" name="quantity" :value="old('quantity')" required />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>
                    <!-- Blood Type -->
                    <select name="bloodType" class="rounded-full bg-gray-100 active:border-red-500 outline-none focus:border-red-500 active:border-red-500 border-2">
                        <option disabled selected>Blood Type</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col gap-2 justify-end items-end mt-4">
                <x-primary-button class="ml-4 ">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    @section('scripts')
        <script>
            $(document).ready(function () {
                $(".promptClient").select2({
                    placeholder: "Search clients",
                    minimumInputLength: 2,
                    width: '100%',
                    multiple: false,
                    ajax: {
                        url: "/clients", // route that returns a collection of clients
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
                                results: data.map(function (client) {
                                    return {
                                        id: client.id,
                                        text: client.name
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
            });
        </script>
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
            }).on("select2:select", function (e) {
                let chosenDonorId = e.params.data.id;

                $.ajax({
                    url: '/donors/'+chosenDonorId,
                    type: 'GET',
                    success: function (donor) {


                        $('#donor_id').val(chosenDonorId);
                        $('#bloodType').removeClass('hidden');
                        if(donor.bloodType){
                            $('#bloodType').attr("disabled", true);
                            $('#bloodType').val(donor.bloodType);
                        }else {
                            $('#bloodType').attr("disabled", false);
                        }
                    }
                });
            });
        </script>

        <script>
            const buttons = document.querySelectorAll('.btn');

            buttons.forEach(button => {
                if (button.classList.contains('active')) {
                    button.classList.add('bg-red-50');
                    button.classList.add('border-b');
                    button.classList.add('border-red-500');
                }
            });
            const handleClick = ({target: button}) => {
                document.querySelectorAll('.btn').forEach(btn => {
                    btn.classList.remove('bg-red-50');
                    btn.classList.remove('border-b');
                    btn.classList.remove('border-red-500');
                });
                button.classList.add('bg-red-50');
                button.classList.add('border-b');
                button.classList.add('border-red-500');
            };

            document.querySelectorAll('.btn').forEach(button => button.addEventListener('click', handleClick));

        </script>
    @endsection


</x-app-layout>
