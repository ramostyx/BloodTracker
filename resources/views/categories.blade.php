<x-app-layout>
    <div class="grid grid-cols-3 gap-4 w-[80%] my-auto mx-auto">
        <div class="flex-col gap-0.5 flex justify-center items-center bg-white rounded-lg py-6 px-12">
            <img src="{{url('images\HomePage.png')}}" alt="Card Image">
            <h1 class="font-bold text-lg">Compaigns</h1>
            <p>Card content goes here</p>
            <a href="{{route('campaigns.index')}}">
                <x-primary-button >Explore</x-primary-button>
            </a>
        </div>
        <div class="flex-col flex gap-0.5 justify-center items-center bg-white rounded-lg py-6 px-12">
            <img src="{{url('images\bloodReq.png')}}" alt="Card Image">
            <h1 class="font-bold text-lg">Blood Request</h1>
            <p>Card content goes here</p>
            <a href="{{route('requests.index')}}">
                <x-primary-button href=#!>Explore</x-primary-button>
            </a>
        </div>
        <div class="flex-col flex gap-0.5 justify-center items-center bg-white rounded-lg py-6 px-12">
            <img src="{{url('images\blog.jpg')}}" alt="Card Image">
            <h1 class="font-bold text-lg">Blogs</h1>
            <p>Card content goes here</p>
            <a href="{{route('blog')}}">
                <x-primary-button >Explore</x-primary-button>
            </a>
        </div>
    </div>

</x-app-layout>


