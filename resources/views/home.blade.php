<x-app-layout>
    <div class="">
        <div class="container mx-auto">
            <div class="flex justify-evenly items-center">
                <div class="text-container flex flex-col gap-2 w-1/2 pl-12">
                    <h1 class="text-5xl font-bold">By being a blood donor , you're a hero</h1>
                    <p class="text-gray-600">Give the gift of life to others...</p>
                    <div>
                        <x-primary-button class="mr-6">
                            {{ __('Donate') }}
                        </x-primary-button>
                    </div>
                </div>
                <div class="image-container w-1/2 bg-cover">
                    <img src="{{url('images\HomePage.png')}}" alt="homepage" >
                </div>
            </div>
        </div>
    </div>
</x-app-layout>







