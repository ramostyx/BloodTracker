<x-app-layout>


    <ul class="nav nav-pills flex flex-col md:flex-row flex-wrap list-none pl-0 mb-4" id="pills-tab3" role="tablist">

        <li class="nav-item" role="presentation">
            <button type="button"
                    class="btn nav-link block font-medium text-xs leading-tight uppercase rounded w-full md:w-auto px-6 py-3 my-2 md:mr-2 focus:outline-none focus:ring-0 active"
                    id="pills-centers-tab3" data-bs-toggle="pill" data-bs-target="#pills-centers" role="tab"
                    aria-controls="pills-centers">

                Blood Transfer Centers
            </button>
        </li>
        <li>
            <button type="button"
                    class="btn nav-link block font-medium text-xs leading-tight uppercase rounded w-full md:w-auto px-6 py-3 my-2 md:mx-2 focus:outline-none focus:ring-0"
                    id="pills-donors-tab3" data-bs-toggle="pill" data-bs-target="#pills-donors" role="tab"
                    aria-controls="pills-donors">
                donors
            </button>
        </li>

        <li>
            <!-- This is an example component -->
            <div class="pt-2 relative mx-auto text-gray-600">
                <form action="/admin">
                    <input
                        class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                        type="search" name="search" placeholder="Search">
                    <button type="submit" class="absolute btn right-0 top-0 mt-5 mr-4">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                             viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                             xml:space="preserve"
                             width="512px" height="512px">
            <path
                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
          </svg>
                    </button>
                </form>
            </div>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent3">
        <div class="tab-pane fade show active" id="pills-centers" role="tabpanel" aria-labelledby="pills-centers-tab3">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-center">
                                <thead class="border-b bg-gray-50">
                                <tr>
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
                                        City
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        <div>
                                            <!--<a href="/center/create" class="button">Add Center</a> -->
                                            <x-primary-button
                                                onclick="window.location.href='/center/create';">
                                                Add Center

                                            </x-primary-button>
                                        </div>
                                    </th>
                                </tr>
                                </thead class="border-b">
                                <tbody>
                                <tr class="bg-white border-b">

                                @forelse($centers as $center)
                                    @if($center->role == 'center')

                                        <tr>
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
                                                {{$center->address->city}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap content-center">
                                                <div>

                                                    <!--<a href="/center/create" class="button">Add center</a> -->
                                                    <form method="POST" action="/admin/{{$center->id}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="text-red-500 ">
                                                            <b>Delete</b>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                    @endif

                                @empty
                                    <div>Pas de contenu</div>
                                @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-donors" role="tabpanel" aria-labelledby="pills-donors-tab3">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-center">
                                <thead class="border-b bg-gray-50">
                                <tr>
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
                                        City
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        <div>
                                            <!--<a href="/center/create" class="button">Add Center</a> -->
                                            <x-primary-button
                                                class=""
                                                onclick="window.location.href='/admin/create_donor';">
                                                Add Donor
                                            </x-primary-button>
                                        </div>
                                    </th>
                                </tr>
                                </thead class="border-b">
                                <tbody>
                                <tr class="bg-white border-b">

                                @forelse($donors as $donor)
                                    @if($donor->role == 'donor')

                                        <tr>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{$donor->name}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{$donor->email}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{$donor->phoneNumber}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{$donor->address->city}}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <div>

                                                    <!--<a href="/donor/create" class="button">Add donor</a> -->
                                                    <form method="POST" action="/admin/{{$donor->id}}">
                                                        @csrf

                                                        @method('DELETE')
                                                        <button class="text-red-500">
                                                            <b>Delete</b>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                    @endif

                                @empty
                                    <div>Pas de contenu</div>
                                @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            const buttons = document.querySelectorAll('.btn');

            buttons.forEach(button => {
                if (button.classList.contains('active')) {
                    button.classList.add('bg-red-500');
                }
            });
            const handleClick = ({target: button}) => {
                document.querySelectorAll('.btn').forEach(btn => {
                    btn.classList.remove('bg-red-500');
                });
                button.classList.add('bg-red-500');
            };

            document.querySelectorAll('.btn').forEach(button => button.addEventListener('click', handleClick));

        </script>
    @endsection


</x-app-layout>
