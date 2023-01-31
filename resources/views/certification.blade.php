<x-app-layout >
    <div class=" mx-auto max-w-3xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-3 py-5 sm:px-5 bg-white">
            <div class="h-96  border-2  border-[#F42A40]">
                <div class="flex ">
                    <img class="ml-1 mt-4 max-w-[150px]" src="{{url('images\certificate.png')}}" alt="certification">
                    <div class="text-center justify-center mt-5">
                        <p class="text-[57px] font-serif font-medium  "> CERTIFICATE </p>
                        <p class="text-3xl font-serif font-medium leading-7"> Proudly presented to </p>
                    </div>
                </div>
                <div class="text-center flex flex-col justify-center items-center gap-1.5">
                    <p class="text-[#2CA4C6] text-7xl font-serif font-medium tracking-wider underline decoration-0 underline-offset-8" >{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                    <div>
                        <p class="text-xl"> You Gave Blood, You Gave life</p>
                        <p class="text-2xl"> You Are <span class="text-[#F42A40]">A Hero</span> Now! </p>
                    </div>
                </div>
                <div class="flex justify-between items-center px-4">
                    <p class=" text-lg underline decoration-0 underline-offset-5">Date</p>
                    <p class=" text-lg underline decoration-0 underline-offset-5">Signature</p>
                </div>

            </div>
        </div>
        <!-- /End replace -->
    </div>
</x-app-layout >
