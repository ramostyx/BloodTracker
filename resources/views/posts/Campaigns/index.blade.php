<x-app-layout>
    @Role('center')
    <div class="flex justify start">
        <a href="{{route('campaigns.create')}}">
            <x-secondary-button>
                {{'__Create a Campaign'}}
            </x-secondary-button>
        </a>
    </div>
    @endRole
    <div class="flex justify-center flex-wrap gap-3 items-center py-2">
        @foreach($campaigns as $campaign)
            <div class="relative w-[60%] flex flex-col justify-center gap-2 items-start px-6 pt-6 pb-2 mx-auto shadow-lg rounded-lg bg-white text-gray-700">
                <div class="absolute flex justify-center gap-0.5 top-3 right-3">
                    <form method="GET" action="{{route('campaign.participants',$campaign->id)}}">
                        @csrf
                        <button class="bg-none" type="submit">
                            <ion-icon name="people-outline"
                                      class="p-4 text-lg hover:bg-green-100 hover:text-green-500 rounded-lg"></ion-icon>
                        </button>
                    </form>
                    <form action="{{route('campaigns.edit',$campaign->id)}}" method="GET">
                        @csrf
                        <button class="bg-none" >
                            <ion-icon name="create-outline" class="p-4 text-lg hover:bg-green-100 hover:text-green-500 rounded-lg"></ion-icon>
                        </button>
                    </form>
                    <form action="{{route('campaigns.destroy',$campaign->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-none" >
                            <ion-icon name="trash-outline" class="p-4 text-lg hover:bg-red-100 hover:text-red-400 rounded-lg"></ion-icon>
                        </button>
                    </form>
                </div>

                <div class="text-gray-500/80 absolute top-1 text-sm left-2">{{date_format($campaign->post->created_at,'M d Y',)}}</div>
                <a href="{{route('campaigns.show',$campaign->id)}}"
                   class="font-semibold text-3xl hover:border-b-2">
                    {{$campaign->post->title}}
                </a>
                <p class="break-words">
                    {{$campaign->post->body}}
                </p>
                @Role('donor')
                @if($campaign->donors->contains(\Illuminate\Support\Facades\Auth::user()->donor))
                    <form action="{{route('campaign.leave',$campaign->id)}}" method="POST">
                        @csrf
                        <x-primary-button type="submit" class="px-6 rounded-md py-2">
                            {{ __('Leave') }}
                        </x-primary-button>
                    </form>
                @else
                    <form action="{{route('campaign.join',$campaign->id)}}" method="POST">
                        @csrf
                        <x-primary-button type="submit" class="px-6 rounded-md py-2">
                            {{ __('Join') }}
                        </x-primary-button>
                    </form>
                @endif
                @endRole

                <div class="flex justify-center text-lg gap-1 ">
                    <div class="flex justify-center items-center gap-1">
                        <a href="#" data-id="{{ $campaign->post->id }}"
                           class="{{$campaign->post->liked() ?'unlike':'like'}}">
                            <ion-icon class="like-icon text-red-500" name="{{$campaign->post->liked() ?'heart':'heart-outline'}}"></ion-icon>
                        </a>
                        <span>{{$campaign->post->likeCount()}}</span>
                    </div>
                    <div class="flex justify-center items-center gap-1">
                        <a href="#" data-id="{{ $campaign->post->id }}"
                           class="{{$campaign->post->bookmarked() ? 'unsave':'save'}}">
                            <ion-icon class="save-icon text-red-500" name="{{$campaign->post->bookmarked() ?'bookmark':'bookmark-outline'}}"></ion-icon>
                        </a>
                        <span>{{$campaign->post->saveCount()}}</span>
                    </div>
                </div>
            </div>
{{--            <div--}}
{{--                class="max-w-5xl flex relative justify-between items-start overflow-hidden gap-12 mx-4 bg-white border border-red-500 text-gray-900 shadow-lg p-6 rounded-xl">--}}
{{--                <div class="flex flex-col justify-evenly gap-6">--}}
{{--                    <div>--}}
{{--                        <a href="{{route('campaigns.show',$campaign->id)}}"--}}
{{--                           class="text-xl font-semibold hover:underline">{{$campaign->post->title}}</a>--}}
{{--                        <h5><span><ion-icon name="location-outline"></ion-icon></span>{{$campaign->location}}</h5>--}}
{{--                        <p>{{$campaign->post->body}}</p>--}}
{{--                    </div>--}}
{{--                    @Role('donor')--}}
{{--                    <form action="#" method="POST">--}}
{{--                        @csrf--}}
{{--                        <x-primary-button type="submit" class="px-6 rounded-md py-2">--}}
{{--                            {{ __('Join') }}--}}
{{--                        </x-primary-button>--}}
{{--                    </form>--}}
{{--                    @endRole--}}
{{--                    @Owner($campaign->post->bloodtransfercenter->user->id)--}}
{{--                    <div class="flex justify-start items-center gap-2">--}}
{{--                        <form method="POST" action="#">--}}
{{--                            @csrf--}}
{{--                            <button class="bg-none" type="submit">--}}
{{--                                <ion-icon name="people-outline"--}}
{{--                                          class="p-2.5 text-lg hover:bg-red-100 text-red-700 rounded-lg"></ion-icon>--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                        <form method="GET" action="{{route('campaigns.edit',$campaign->id)}}">--}}
{{--                            @csrf--}}
{{--                            <button class="bg-none" type="submit">--}}
{{--                                <ion-icon name="create-outline"--}}
{{--                                          class="p-2.5 text-lg hover:bg-red-100 text-red-700 rounded-lg"></ion-icon>--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                        <form method="POST" action="{{route('campaigns.destroy',$campaign->id)}}">--}}
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

{{--                <div class="absolute right-0 top-0 bg-blue-400 px-1 text-sm text-white">--}}
{{--                    {{ date('d M', strtotime($campaign->created_at)) }}--}}
{{--                </div>--}}
{{--                <div class="absolute right-2 flex justify-center text-xs gap-1 bottom-1">--}}
{{--                    <div class="flex justify-center items-center gap-1">--}}
{{--                        <a href="#" data-id="{{ $campaign->post->id }}"--}}
{{--                           class="{{$campaign->post->liked() ?'unlike':'like'}}">--}}
{{--                            <ion-icon class="like-icon text-red-500" name="{{$campaign->post->liked() ?'heart':'heart-outline'}}"></ion-icon>--}}
{{--                        </a>--}}
{{--                        <span>430</span>--}}
{{--                    </div>--}}
{{--                    <div class="flex justify-center items-center gap-1">--}}
{{--                        <a href="#" data-id="{{ $campaign->post->id }}"--}}
{{--                           class="{{$campaign->post->bookmarked() ? 'unsave':'save'}}">--}}
{{--                            <ion-icon class="save-icon text-red-500" name="{{$campaign->post->bookmarked() ?'save':'save-outline'}}"></ion-icon>--}}
{{--                        </a>--}}
{{--                        <span>430</span>--}}
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
