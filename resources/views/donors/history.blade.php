<x-app-layout>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <a href="{{route('certificate')}}">
                    <x-primary-button   class="{{$donations->isEmpty() ? 'disabled' : ''}} mb-2 " >
                        {{ __('certificate') }}
                    </x-primary-button>
                </a>

                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                        <tr>
                            <th scope="col"
                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Center Name
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
                        @foreach($donations as $donation)
                            <tr class="bg-white border-b ">
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$donation->bloodtransfercenter->user->name}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ date('Y-m-d', strtotime($donation->pivot->created_at)) }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$donation->bloodType}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$donation->pivot->quantity}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
