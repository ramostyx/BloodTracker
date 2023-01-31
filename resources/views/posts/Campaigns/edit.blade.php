<x-app-layout>
    <div class="rounded-tr-xl text-gray-700 rounded-bl-xl bg-white max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('campaigns.update',$campaign->id) }}" enctype="multipart/form-data"
              class="py-6 px-12 text-center">
            @csrf
            @method('PUT')


            <h2 class="text-4xl font-medium font-semibold text-gray-900 mb-4">
                {{ __('Edit a campaign') }}
            </h2>

            <!-- Title -->
            <div>
                <x-text-input placeholder="Campaign title" id="title" class="block mt-1 w-full rounded-full bg-gray-100"
                              type="text" name="title" value="{{$campaign->post->title}}"  autofocus/>
                <x-input-error :messages="$errors->get('title')" class="mt-2"/>
            </div>

            <!-- Description -->
            <div class="mt-4">
                <textarea placeholder="Description" id="description"
                          class="block mt-1 w-full rounded-full bg-gray-100 border-gray-300 focus:border-red-500/90 focus:ring-red-500/90 rounded-md shadow-sm"
                          type="text" name="description" >{{$campaign->post->body}}</textarea>
                <x-input-error :messages="$errors->get('Description')" class="mt-2"/>
            </div>

            <!--Dates-->
            <div class="flex justify-center gap-2 mt-4">
                <!-- Start Date -->
                <x-text-input
                    name="startDate"
                    type="datetime-local"
                    class="block mt-1 w-full rounded-full bg-gray-100"
                    id="startDate"
                    value="{{$campaign->startDate}}"
                    placeholder="start date"
                />

                <!-- End Date -->
                <x-text-input
                    name="endDate"
                    type="datetime-local"
                    class="block mt-1 w-full rounded-full bg-gray-100"
                    id="endDate"
                    value="{{$campaign->endDate}}"
                    placeholder="end date"
                />
            </div>


            <!--Location-->

            <div class="mt-4">
                <x-text-input placeholder="Location" id="location"
                              class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="location"
                              value="{{$campaign->location}}" />
                <x-input-error :messages="$errors->get('location')" class="mt-2"/>
            </div>


            <!-- thumbnail -->
            <!-- Attachments -->
            <div class="mt-4 flex justify-center gap-2">
                <div class="block mt-1 w-full">
                    <input
                        name="thumbnail"
                        type="file"
                        id="thumbnail"
                        accept="image/png, image/jpeg">
                </div>
                <div class="block mt-1 w-full">
                    <input
                        name="attachment[]"
                        type="file"
                        id="attachment"
                        multiple
                    />
                </div>
            </div>


            <div class="flex flex-col gap-2 justify-end items-end mt-4">
                <x-primary-button class="ml-4 ">
                    {{ __('Publish') }}
                </x-primary-button>
            </div>
        </form>
    </div>
    <!--Scripts-->
    @section('scripts')
        <script type="module">

            const inputElement1 = document.querySelector('input[id="attachment"]');
            const inputElement = document.querySelector('input[id="thumbnail"]');
            FilePond.create(inputElement1, {
                labelIdle: `Drag & Drop attachments for your post`,
            });
            FilePond.create(inputElement, {
                labelIdle: `Drag & Drop a thumbnail for your post`,
            });
            FilePond.setOptions({
                server: {
                    url: '/upload',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                }
            });

            let startDate = flatpickr("#startDate", {
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function (selectedDates, dateStr, instance) {
                    endDate.set("minDate", dateStr);
                }
            });

            let endDate = flatpickr("#endDate", {
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function (selectedDates, dateStr, instance) {
                    startDate.set("maxDate", dateStr);
                }
            });
        </script>
    @endsection
</x-app-layout>
