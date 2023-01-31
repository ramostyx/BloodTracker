<x-app-layout>
    <div class="rounded-tr-xl rounded-bl-xl bg-white max-w-xl mx-auto mt-6 text-gray-700">
        <form method="POST" action="{{ route('requests.update',$request->id) }}" enctype="multipart/form-data"
              class="py-6 px-12 ">
            @csrf
            @method('PUT')

            <h2 class="text-4xl font-medium font-semibold text-gray-900 mb-4">
                {{ __('Edit a request') }}
            </h2>

            <!-- Title -->
            <div>
                <x-text-input placeholder="Campaign title" id="title" class="block mt-1 w-full rounded-full bg-gray-100"
                              type="text" name="title" value="{{$request->post->title}}" required autofocus/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
            </div>

            <!-- Description -->
            <div class="mt-4">
                <textarea placeholder="Description" id="description"
                          class="block mt-1 w-full rounded-full bg-gray-100 border-gray-300 focus:border-red-500/90 focus:ring-red-500/90 rounded-md shadow-sm"
                          type="text" name="description" required>{{$request->post->body}}</textarea>
                <x-input-error :messages="$errors->get('Description')" class="mt-2"/>
            </div>

            <!--RequiredBlood-->
            <div class="mt-4">
                <select id="requiredBlood" multiple="multiple" name="requiredBlood[]" >
                    <option {{in_array('O+',$request->requiredBloodTypes) ? 'selected':''}}>O+</option>
                    <option {{in_array('O-',$request->requiredBloodTypes) ? 'selected':''}}>O-</option>
                    <option {{in_array('A+',$request->requiredBloodTypes) ? 'selected':''}}>A+</option>
                    <option {{in_array('A-',$request->requiredBloodTypes) ? 'selected':''}}>A-</option>
                    <option {{in_array('B+',$request->requiredBloodTypes) ? 'selected':''}}>B+</option>
                    <option {{in_array('B-',$request->requiredBloodTypes) ? 'selected':''}}>B-</option>
                    <option {{in_array('AB+',$request->requiredBloodTypes) ? 'selected':''}}>AB+</option>
                    <option {{in_array('AB-',$request->requiredBloodTypes) ? 'selected':''}}>AB-</option>
                </select>
            </div>

            <!--Urgency level-->
            <div class="mt-4">
                <select name="urgency" class="block mt-1 w-full rounded-full bg-gray-100">
                    <option disabled>Urgency Level</option>
                    <option {{'low'==$request->urgency ? 'selected':''}}>Low</option>
                    <option {{'medium'==$request->urgency ? 'selected':''}}>Medium</option>
                    <option {{'high'==$request->urgency ? 'selected':''}}>High</option>
                </select>
            </div>





            <div class="flex flex-col gap-2 justify-end items-end mt-4">
                <x-primary-button class="ml-4 ">
                    {{ __('Publish') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function () {
                $("#requiredBlood").select2({
                    placeholder: "Required Blood Types",
                    width: '100%',
                    multiple: true,
                });
            });
        </script>
    @endsection

</x-app-layout>
