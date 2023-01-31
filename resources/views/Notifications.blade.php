
<x-app-layout>

    <div class="mt-4">
        <div class="flex flex-wrap justify-between">
            <a href="#" id="mark-all"
               class="inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-blue-100 focus:text-blue-700 focus:bg-blue-100 focus:outline-none focus:ring-0 active:bg-blue-200 active:text-blue-800 transition duration-300 ease-in-out">
                Mark all as read
            </a>
        </div>
    </div>
    <div class="py-5">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            @foreach($notifications as $notification)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2 alert alert-success">
                    <div class="p-4 bg-white border-b border-gray-200">
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body flex justify-between items-center" >
                                            <div class=" flex flex-col gap-1">
                                                <span class="text-sm font-light">
                                                    {{$notification->created_at->translatedFormat('j F') }}
                                                </span>
                                                <span class="text-sm font-light">
                                                    {{$notification->created_at->translatedFormat('H:i') }}
                                                </span>
                                            </div>
                                            {{$notification->data['message']}}
                                            <a href="#" data-id="{{ $notification->id }}"
                                               class="mark-as-read float-right inline-block px-6 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-blue-100 focus:text-blue-700 focus:bg-blue-100 focus:outline-none focus:ring-0 active:bg-blue-200 active:text-blue-800 transition duration-300 ease-in-out">
                                                Mark as Read
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @section('scripts')
        <script>
            function sendMarkRequest(id = null) {
                return $.ajax("{{ route('markNotification') }}", {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    data: {
                        id,
                    }
                });
            }
            $(function() {
                $('.mark-as-read').click(function() {
                    let request = sendMarkRequest($(this).data('id'));
                    request.done(() => {
                        $(this).parents('div.alert').remove();
                    });
                });

                $('#mark-all').click(function() {
                    let request = sendMarkRequest();
                    request.done(() => {
                        $('div.alert').remove();
                    });
                });
            });
        </script>
    @endsection
</x-app-layout>

