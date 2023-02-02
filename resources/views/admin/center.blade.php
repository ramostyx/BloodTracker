<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Centres de transfusion sanguins") }}
                </div>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                      <table class="min-w-full text-center">
                        <thead class="border-b bg-gray-50">
                          <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                              Logo
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                              Name
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                              Email
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                              Phone Number
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                              id
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                <div>
                                    <!--<a href="/center/create" class="button">Add Center</a> -->

                                    <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" onclick="window.location.href='/admin/create_center';">

                                        Add Center
                                      </button>
                                    </div>
                            </th>
                          </tr>
                        </thead class="border-b">
                        <tbody>
                          <tr class="bg-white border-b">
                            @unless (count($centers) == 0)
                            @foreach($centers as $center)

                            <tr>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                  {{$center->name}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$center->email}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$center->phoneNumber}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{$center->phoneNumber}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <div>

                                        <!--<a href="/center/create" class="button">Add Center</a> -->
                                        <form method="POST" class="mt-4 p-2 flex space-x-6" action="/center/{{$center->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500" >
                                                <b>Delete</b>
                                            </button>
                                        </form>
                                        </div>
                                </td>

                            </tr>
                            @endforeach

                            @else
                            <div>Pas de contenu</div>
                            @endunless


                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>











</x-app-layout>
