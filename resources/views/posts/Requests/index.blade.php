<x-app-layout>
    @Role('center')
    <div class="flex justify start">
        <a href="{{route('requests.create')}}">
            <x-secondary-button>
                {{'__Create a Campaign'}}
            </x-secondary-button>
        </a>
    </div>
    @endRole
    <div class="flex justify-center flex-wrap gap-3 items-center py-2">
        @foreach($requests as $request)
            <div
                class="relative w-[60%] flex flex-col justify-center gap-2 items-start px-6 pt-6 pb-2 mx-auto shadow-lg rounded-lg bg-white text-gray-700">
                <div class="absolute flex justify-center gap-0.5 top-3 right-3">
                    <form action="{{route('requests.edit',$request->id)}}" method="GET">
                        @csrf
                        <button class="bg-none">
                            <ion-icon name="create-outline"
                                      class="p-4 text-lg hover:bg-green-100 hover:text-green-500 rounded-lg"></ion-icon>
                        </button>
                    </form>
                    <form action="{{route('requests.destroy',$request->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-none">
                            <ion-icon name="trash-outline"
                                      class="p-4 text-lg hover:bg-red-100 hover:text-red-400 rounded-lg"></ion-icon>
                        </button>
                    </form>
                </div>

                <div
                    class="text-gray-500/80 absolute top-1 text-sm left-2">{{date_format($request->post->created_at,'M d Y',)}}</div>
                <a href="{{route('requests.show',$request->id)}}"
                   class="font-semibold text-3xl hover:border-b-2">
                    {{$request->post->title}}
                </a>
                <p class="break-words">
                    {{$request->post->body}}
                </p>
                <h5>
                    Required blood types:
                    <span>{{implode(', ',$request->requiredBloodTypes)}}</span>
                </h5>
                <div class="w-full bg-gray-300 h-2 rounded-lg mt-2">
                    <div class="bg-red-600 h-2 relative rounded-lg"
                         style="width: {{$request->progress()}}%">
                    </div>
                </div>
                <div class="flex justify-center text-lg gap-1 ">
                    <div class="flex justify-center items-center gap-1">
                        <a href="#" data-id="{{ $request->post->id }}"
                           class="{{$request->post->liked() ?'unlike':'like'}}">
                            <ion-icon class="like-icon text-red-500"
                                      name="{{$request->post->liked() ?'heart':'heart-outline'}}"></ion-icon>
                        </a>
                        <span>{{$request->post->likeCount()}}</span>
                    </div>
                    <div class="flex justify-center items-center gap-1">
                        <a href="#" data-id="{{ $request->post->id }}"
                           class="{{$request->post->bookmarked() ? 'unsave':'save'}}">
                            <ion-icon class="save-icon text-red-500"
                                      name="{{$request->post->bookmarked() ?'bookmark':'bookmark-outline'}}"></ion-icon>
                        </a>
                        <span>{{$request->post->saveCount()}}</span>
                    </div>
                </div>
            </div>
            {{--            <div class="max-w-7xl flex relative justify-between items-start overflow-hidden gap-12 mx-4 bg-[rgb(217,217,217)] text-gray-900 shadow-lg p-6 rounded-xl">--}}
            {{--                <div class="flex flex-col justify-evenly gap-6">--}}
            {{--                    <div>--}}
            {{--                        <div class="flex justify-start items-center gap-2">--}}
            {{--                            <a href="{{route('requests.show',$request->id)}}" class="text-xl font-semibold hover:underline">{{$request->post->title}}</a>--}}
            {{--                            <h5><span><ion-icon name="location-outline"></ion-icon></span>province</h5>--}}
            {{--                        </div>--}}

            {{--                        <h5 >--}}
            {{--                            Required blood types:--}}
            {{--                            <span>{{implode(', ',$request->requiredBloodTypes)}}</span>--}}
            {{--                        </h5>--}}
            {{--                        <p>{{$request->post->body}}</p>--}}
            {{--                                    <div class="w-full bg-gray-300 h-2 rounded-lg mt-2">--}}
            {{--                                        <div class="bg-red-600 h-2 relative rounded-lg"--}}
            {{--                                             style="width: {{$request->progress()}}%">--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                    </div>--}}

            {{--                    @Owner($request->post->bloodtransfercenter->user->id)--}}
            {{--                    <div class="flex justify-start items-center gap-2">--}}

            {{--                        <form method="GET" action="{{route('requests.edit',$request->id)}}">--}}
            {{--                            @csrf--}}
            {{--                            <button class="bg-none" type="submit">--}}
            {{--                                <ion-icon name="create-outline"--}}
            {{--                                          class="p-2.5 text-lg hover:bg-red-100 text-red-700 rounded-lg"></ion-icon>--}}
            {{--                            </button>--}}
            {{--                        </form>--}}
            {{--                        <form method="POST" action="{{route('requests.destroy',$request->id)}}">--}}
            {{--                            @csrf--}}
            {{--                            @method('DELETE')--}}
            {{--                            <button class="bg-none" type="submit">--}}
            {{--                                <ion-icon name="trash-outline"--}}
            {{--                                          class="p-2.5 text-lg hover:bg-red-100 text-red-700 rounded-lg"></ion-icon>--}}
            {{--                            </button>--}}
            {{--                        </form>--}}
            {{--                    </div>--}}
            {{--                    @endRole--}}

            {{--                </div>--}}

            {{--                <div class="flex items-center justify-center h-36 w-36 rounded-full bg-white bg-center bg-cover" style="background-image: url('{{$request->post->thumbnail}}') ;">--}}
            {{--                </div>--}}
            {{--                <div class="absolute right-0 top-0 bg-red-500 px-1 text-sm text-white">--}}
            {{--                    {{ date('d M', strtotime($request->created_at)) }}--}}
            {{--                </div>--}}
            {{--                <div class="absolute right-2 flex justify-center text-xs gap-1 bottom-1">--}}
            {{--                    <div class="flex justify-center items-center gap-1">--}}
            {{--                        <ion-icon class="text-blue-700" name="heart-outline"></ion-icon>--}}
            {{--                        <span>430</span>--}}
            {{--                    </div>--}}
            {{--                    <div class="flex justify-center items-center gap-1">--}}
            {{--                        <ion-icon class="text-blue-700" name="bookmark-outline"></ion-icon>--}}
            {{--                        <span>43</span>--}}
            {{--                    </div>--}}
            {{--                </div>--}}

            {{--            </div>--}}
        @endforeach
    </div>

    @section('scripts')
        <script>

            $(document).on('click', '.like', function () {
                let button = $(this);
                let id = button.data('id');
                let icon = document.querySelector('.like-icon');
                icon.setAttribute('name', 'heart');

                $.ajax({
                    url: `/posts/${id}/like`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        button.removeClass('like');
                        button.addClass('unlike');
                    }
                });
            });

            $(document).on('click', '.unlike', function () {
                let button = $(this);
                let id = button.data('id');
                let icon = document.querySelector('.like-icon');
                icon.setAttribute('name', 'heart-outline');

                $.ajax({
                    url: `/posts/${id}/unlike`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        button.removeClass('unlike');
                        button.addClass('like');
                    }
                });
            });

            $(document).on('click', '.save', function () {
                let button = $(this);
                let id = button.data('id');
                let icon = document.querySelector('.save-icon');
                icon.setAttribute('name', 'bookmark');

                $.ajax({
                    url: `/posts/${id}/save`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        button.removeClass('save');
                        button.addClass('unsave');
                    }
                });
            });

            $(document).on('click', '.unsave', function () {
                let button = $(this);
                let id = button.data('id');
                let icon = document.querySelector('.save-icon');
                icon.setAttribute('name', 'bookmark-outline');

                $.ajax({
                    url: `/posts/${id}/unsave`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        button.removeClass('unsave');
                        button.addClass('save');
                    }
                });
            });

        </script>
    @endsection


</x-app-layout>
