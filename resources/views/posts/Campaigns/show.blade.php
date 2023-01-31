<x-app-layout>
    <div class="grid grid-cols-4 gap-3 ">
        <div class="col-span-1 ">
            <img src="{{asset($campaign->post->thumbnail)}}">
        </div>
        <div class="col-span-3 flex flex-col gap-4 justify-start ">
            {{--            <div>{{$campaign->post->bloodtransfercenter->user->name}}</div>--}}
            <div class="flex justify-start items-center gap-2">
                <div>
                    <div class="w-12 h-12 rounded-full overflow-hidden">
                        <img  src="{{asset($campaign->post->bloodtransfercenter->user->profileImage)}}">
                    </div>
                </div>
                <div>
                    <h5 class="font-semibold">{{$campaign->post->bloodtransfercenter->user->name}}</h5>
                </div>
            </div>
            <div class="bg-red-500 px-3 relative py-2 text-white rounded-lg">
                <h2 class="text-xl font-bold">{{$campaign->post->title}}</h2>
                <div class="flex justify-start items-center gap-1">
                    <ion-icon name="location-outline"></ion-icon>
                    <h5 class="text-sm font-semibold">{{$campaign->location}}</h5>
                </div>

                <p>
                    {{$campaign->post->body}}
                </p>
            </div>
            @if($campaign->post->attachments->isNotEmpty())
                <div class="flex justify-start items-center gap-2">
                    @foreach($campaign->post->attachments as $attachment)
                        <div class="ml-2 bg-gray-200/80 px-2 py-2.5 rounded-3xl flex justify-center items-center gap-1">
                            <a href="{{route('download',$attachment->id)}}">
                                {{$attachment->filename}}
                            </a>
                            @Owner($campaign->post->bloodtransfercenter->user->id)
                                <form method="POST" action="{{route('attachment.destroy',$attachment->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="flex justify-center items-center">
                                        <ion-icon  name="close-outline" class="hover:bg-gray-400 rounded-xl"></ion-icon>
                                    </button>
                                </form>
                            @endOwner
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="bg-white border-2 border-red-500 rounded-lg p-4 ">
                @auth
                    <form action="{{route('comment.make',$campaign->post->id)}}" method="POST" class="flex gap-2">
                        @csrf

                        <div>
                            <div class="w-12 h-12 rounded-full overflow-hidden">
                                <img src="{{asset(\Illuminate\Support\Facades\Auth::user()->profileImage)}}"/>
                            </div>
                        </div>
                        <x-text-input placeholder="you have a question? ask away" id="comment"
                                      class="block mt-1 w-full rounded-lg bg-gray-100"
                                      type="text" name="comment" :value="old('comment')" required autofocus/>
                        <div class="flex items-center justify-end mt-2 ">
                            <button class="bg-none" type="submit">
                                <ion-icon name="send-outline"
                                          class="p-2.5 text-lg hover:bg-red-100 text-red-700 rounded-lg"></ion-icon>
                            </button>
                        </div>
                    </form>
                @endauth

                <button
                    type="button"
                    class="mt-2"
                    data-mdb-ripple="true"
                    data-mdb-ripple-color="light"
                    data-bs-toggle="collapse" data-bs-target="#commentcollapse" aria-expanded="false"
                    aria-controls="commentcollapse">
                    <div class="flex justify-center items-center">
                        <span>All Comments</span>
                        <ion-icon
                            class=" text-gray-500 font-medium text-lg"
                            name="chevron-down-outline"></ion-icon>
                    </div>

                </button>
                <div class="collapse show" id="commentcollapse">
                    @foreach($campaign->post->comments->sortByDesc('created_at') as $comment)
                        <div class="flex gap-2 justify-start items-start text-gray-500 mt-1">
                            <div>
                                <div class="w-8 h-8 rounded-full overflow-hidden"
                                    <img src="{{asset($comment->user->profileImage)}}">
                                </div>
                            </div>
                            <div class="mt-1.5 flex-grow">
                                <div>
                                    <div>
                                        <h5 class="font-semibold">{{$comment->user->name}}:
                                            <span>{{$comment->body}}</span></h5>
                                    </div>
                                    <div class="flex justify-between items-start text-xs gap-1.5">
                                        <div class="flex justify-start items-center">
                                             <span>
                                            {{(new \Carbon\Carbon($comment->created_at))->diffForHumans(\Carbon\Carbon::now())}}
                                        </span>
                                            <button
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#repliescollapse{{$loop->iteration}}"
                                                aria-expanded="false" aria-controls="repliescollapse">
                                                <div class="text-xs flex justify-start items-start gap-0.5">
                                                    <ion-icon
                                                        class=" text-gray-500 font-medium rotate-180 text-lg"
                                                        name="arrow-undo-circle-outline"></ion-icon>
                                                    <span>reply</span>
                                                    <span
                                                        class="px-1 rounded-full bg-gray-500 text-white">{{$comment->comments->count()}}</span>
                                                </div>
                                            </button>
                                        </div>

                                        @Owner($comment->user->id)
                                        <div class="text-lg">
                                            <form action="{{route('comment.destroy',$comment->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-none" >
                                                    <ion-icon name="trash-outline" class="p-1.5 text-md hover:bg-red-100 hover:text-red-400 rounded-lg"></ion-icon>                                                    </button>
                                            </form>
                                        </div>
                                        @endOwner
                                    </div>
                                </div>

                                <div>
                                    <div class="p-1 collapse text-sm" id="repliescollapse{{$loop->iteration}}">
                                        <div class="flex flex-col gap-2">
                                            @foreach($comment->comments as $reply)
                                                <div class="flex gap-2 justify-start items-start text-gray-500">
                                                    <div>
                                                        <div class="w-8 h-8 rounded-full overflow-hidden">
                                                        <img src="{{asset($reply->user->profileImage)}}">
                                                    </div>

                                                    <div class="mt-2 flex-grow">
                                                        <div>
                                                            <h5 class="font-semibold">{{$reply->user->name}}:
                                                                <span>{{$reply->body}}</span></h5>
                                                        </div>
                                                        <div class="flex justify-between items-start gap-1">
                                                            <span class="text-xs">
                                                            {{(new \Carbon\Carbon($reply->created_at))->diffForHumans(\Carbon\Carbon::now())}}
                                                        </span>
                                                            @Owner($reply->user->id)
                                                            <div class="text-xs">
                                                                <form action="{{route('comment.destroy',$reply->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="bg-none" >
                                                                        <ion-icon name="trash-outline" class="p-1.5 text-md hover:bg-red-100 hover:text-red-400 rounded-lg"></ion-icon>                                                    </button>
                                                                </form>
                                                            </div>
                                                            @endOwner
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        </div>
                                        @auth
                                            <div class="w-full">
                                                <form action="{{route('comment.reply',$comment->id)}}" method="POST"
                                                      class="flex justify-center items-center gap-2 py-3">
                                                    @csrf

                                                    <div>
                                                        <div class="w-8 h-8 rounded-full overflow-hidden"
                                                        <img src="{{asset($reply->user->profileImage)}}">
                                                    </div>
                                                    </div>
                                                    <x-text-input placeholder="Reply to {{$comment->user->name}}" id="reply"
                                                                  class="block mt-1 w-full text-sm rounded-lg bg-gray-100"
                                                                  type="text" name="reply" :value="old('reply')"
                                                                  required autofocus/>
                                                    <div class="flex items-center justify-end mt-2 ">
                                                        <button class="bg-none" type="submit">
                                                            <ion-icon name="send-outline"
                                                                      class="p-1.5 hover:bg-red-100 text-red-700 rounded-lg"></ion-icon>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
