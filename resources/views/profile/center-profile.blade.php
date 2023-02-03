<x-app-layout>
    <div class="grid grid-cols-3 gap-2 px-56 ">
        <div class="h-full pb-24 bg-white relative col-span-1 flex flex-col justify-start items-center p-2">
            <div class="block mt-1 w-24">
                <form action="{{route('profile.change')}}" method="POST">
                    @csrf
                    <input
                        name="profile"
                        type="file"
                        id="profile"
                        accept="image/png, image/jpeg">
                    <div class="flex justify-center absolute left-0 right-0  bottom-20 items-center">
                        <x-primary-button type="submit" >
                            change profile
                        </x-primary-button>
                    </div>
                </form>

            </div>
            <h3 class="text-xl font-bold">{{\Illuminate\Support\Facades\Auth::user()->name}}</h3>
            <h4 class="text-lg">
                <span><ion-icon name="location-outline"></ion-icon></span>
                {{\Illuminate\Support\Facades\Auth::user()->address->city}}
            </h4>
            <form action="/" class="w-full px-2">
                <label class="relative flex justify-between items-center w-full text-[15px] p-1 font-bold">
                    Activate notifications
                    <input type="checkbox" class="absolute hidden left-0 top-0 w-full h-full peer ">
                    <span class="bg-gray-300 w-11 h-7 rounded-full flex flex-shrink-0  after:bg-white
                                    after:w-5 after:h-5 after:rounded-full p-1 peer-checked:bg-[#2CA4C6] peer-checked:after:translate-x-4 ease-in-out duration-300 after:duration-300 ml-4"></span>
                </label>
            </form>
            <div class="w-full flex font-bold text-[15px] justify-start py-1 px-3 items-center">
                <p> Donations: </p>
                <p>{{\Illuminate\Support\Facades\Auth::user()->bloodtransfercenter->donationsCount() }}</p>
            </div>

            <div class="w-full px-3 py-1 flex font-bold text-left text-[15px] justify-start items-start">
                <p> Posts: </p>
                <p>{{\Illuminate\Support\Facades\Auth::user()->bloodtransfercenter->posts->count()}}</p>
            </div>

        </div>
        <div class="bg-white col-span-2 p-4">
            <ul class="nav nav-pills flex flex-col md:flex-row flex-wrap list-none pl-0 mb-4" id="pills-tab3"
                role="tablist">
                <li class="nav-item" role="presentation">
                    <button type="button" class="block active btn font-medium text-xs leading-tight uppercase rounded-t-xl  active:border-b
  active:bg-red-50
  active:border-red-500
  hover:border-b
  hover:bg-red-50
  hover:border-red-500 w-full md:w-auto px-6 py-3 my-2 md:mr-2 focus:outline-none focus:ring-0"
                            id="pills-personal-info-tab3" data-bs-toggle="pill"
                            data-bs-target="#pills-personal-info" role="tab" aria-controls="pills-personal-info"
                            aria-selected="true">
                        Personal Information
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="
  block
  btn
  font-medium
  text-xs
  leading-tight
  uppercase
  rounded-t-xl
  active:border-b
  active:bg-red-50
  active:border-red-500
  hover:border-b
  hover:bg-red-50
  hover:border-red-500
  w-full
  md:w-auto
  px-6
  py-3
  my-2
  md:mx-2
  focus:outline-none focus:ring-0
" id="pills-security-tab3" data-bs-toggle="pill" data-bs-target="#pills-security" role="tab"
                            aria-controls="pills-security" aria-selected="false">
                        Security
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent3">
                <div class="tab-pane fade show active" id="pills-personal-info" role="tabpanel"
                     aria-labelledby="pills-personal-info-tab3">
                    <form class="m-1" method="POST" action="/profile/{{$user->id}}">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div class="my-2 ">
                            <x-text-input placeholder="Full name" id="name"
                                          class="block mt-4 w-full rounded-full bg-gray-100" type="text" name="name"
                                          value="{{$user->name}}" autofocus/>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-2">
                            <x-text-input placeholder="Email" id="email"
                                          class="block mt-4 w-full rounded-full bg-gray-100" type="email" name="email"
                                          value="{{$user->email}}"/>
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <x-text-input placeholder="Phone Number" id="phone"
                                          class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="phone"
                                          value="{{$user->phoneNumber}}"/>
                        </div>
                        <!-- Address -->

                        <div class="grid grid-rows-2">
                            <div class="grid grid-cols-3 gap-2">
                                <!-- country -->
                                <div class="mt-4">
                                    <x-text-input placeholder="Country" id="country"
                                                  class="block mt-1 w-full rounded-full bg-gray-100" type="text"
                                                  name="country" value="{{$user->Address->country}}"/>

                                </div>
                                <!-- city -->
                                <div class="mt-4">
                                    <x-text-input placeholder="City" id="city"
                                                  class="block mt-1 w-full rounded-full bg-gray-100" type="text"
                                                  name="city" value="{{$user->Address->city}}"/>

                                </div>
                                <!-- zipCode -->
                                <div class="mt-4">
                                    <x-text-input placeholder="Zip code" id="zipCode"
                                                  class="block mt-1 w-full rounded-full bg-gray-100" type="text"
                                                  name="zipCode" pattern="[0-9]{5}"
                                                  value="{{$user->Address->zipCode}}"/>

                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <!-- province -->
                                <div class="mt-4">
                                    <x-text-input placeholder="Province" id="province"
                                                  class="block mt-1 w-full rounded-full bg-gray-100" type="text"
                                                  name="province" value="{{$user->Address->province}}"/>

                                </div>
                                <!-- street -->
                                <div class="mt-4">
                                    <x-text-input placeholder="Street" id="street"
                                                  class="block mt-1 w-full rounded-full bg-gray-100" type="text"
                                                  name="street" value="{{$user->Address->street}}"/>

                                </div>
                            </div>
                        </div>
                        <!-- EditButton -->
                        <div class="flex justify-end mt-4">
                            <x-primary-button type="submit">
                                Edit your profile
                            </x-primary-button>

                        </div>
                    </form>

                </div>
                <div class="tab-pane fade" id="pills-security" role="tabpanel"
                     aria-labelledby="pills-security-tab3">
                    <form class="m-1" method="POST" action="/profile">
                        @csrf
                        <!-- CurrentPassword -->
                        <div class="my-4">

                            <x-text-input placeholder="Current Password" id="currentpassword"
                                          class="block mt-1 w-full rounded-full bg-gray-100"
                                          type="password"
                                          name="current_password"
                                          required/>

                            @error('current_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <!-- NewPassword -->
                        <div class="my-4">

                            <x-text-input placeholder="New Password" id="newpassword"
                                          class="block mt-1 w-full rounded-full bg-gray-100"
                                          type="password"
                                          name="new_password"
                                          required/>

                            @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NewPasswordConfirmation -->
                        <div class="my-4">

                            <x-text-input placeholder="New Password Confirmation" id="newpasswordconfirm"
                                          class="block mt-1 w-full rounded-full bg-gray-100"
                                          type="password"
                                          name="new_password_confirmation"
                                          required/>

                            @error('new_password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <!-- EditButton -->
                        <div class=" absolute bottom-33 right-64 mt-2 mr-6">
                            <button type="submit"
                                    class="inline-flex justify-center rounded-full border border-transparent bg-[#F42A40] py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-[#e52a40] focus:outline-none focus:ring-2 focus:ring-[#bb1f31] focus:ring-offset-2">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            const buttons = document.querySelectorAll('.btn');

            buttons.forEach(button => {
                if (button.classList.contains('active')) {
                    button.classList.add('bg-red-50');
                    button.classList.add('border-b');
                    button.classList.add('border-red-500');
                }
            });
            const handleClick = ({target: button}) => {
                document.querySelectorAll('.btn').forEach(btn => {
                    btn.classList.remove('bg-red-50');
                    btn.classList.remove('border-b');
                    btn.classList.remove('border-red-500');
                });
                button.classList.add('bg-red-50');
                button.classList.add('border-b');
                button.classList.add('border-red-500');
            };

            document.querySelectorAll('.btn').forEach(button => button.addEventListener('click', handleClick));

        </script>

        <script type="module">
            const inputElement = document.querySelector('input[id="profile"]');
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImagePreview,
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageTransform,
                FilePondPluginImageEdit
            );
            FilePond.create(inputElement, {
                labelIdle: `Drag & Drop your profile image`,
                imagePreviewHeight: 150,
                imageCropAspectRatio: '1:1',
                imageResizeTargetWidth: 100,
                imageResizeTargetHeight: 100,
                stylePanelLayout: 'compact circle',
                styleLoadIndicatorPosition: 'center bottom',
                styleProgressIndicatorPosition: 'right bottom',
                styleButtonRemoveItemPosition: 'center top',
                styleButtonProcessItemPosition: 'right bottom',
            });
            FilePond.setOptions({
                server: {
                    url: '/upload',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                }
            });
        </script>
    @endsection
</x-app-layout>




