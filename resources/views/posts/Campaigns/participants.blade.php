<x-app-layout>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                        <tr>
                            <th scope="col"
                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Name
                            </th>
                            <th scope="col"
                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Email
                            </th>
                            <th scope="col"
                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Phone Number
                            </th>
                            <th scope="col"
                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                blood Type
                            </th>
                            <th scope="col"
                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                City
                            </th>
                            <th scope="col"
                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Province
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($participants as $participant)
                            <tr class="bg-white border-b ">
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$participant->user->name}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$participant->user->email}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$participant->user->phoneNumber}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$participant->bloodType}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$participant->user->address->city}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$participant->user->address->province}}
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
