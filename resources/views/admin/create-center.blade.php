<x-app-layout>
<<<<<<< HEAD
<form method="post" action="/center/creation"  style="margin: auto; width: 50%;"  >
    @csrf
    <div class="field" >
        <label class="label">Name</label>
        <div class="control">
          <input class="input" type="text" name="name" placeholder="Center Name" value="{{ old('name') }}" >
        </div>
        @error('name')
            <p class="text-red-500 text-xs mt-1" >{{$message}}</p>
        @enderror
      </div>
      
      <div class="field">
        <label class="label">Email</label>
        <div class="control has-icons-left has-icons-right">
          <input class="input is-danger" type="email" name="email" placeholder="Center Email" value={{ old('email') }}>
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
          <span class="icon is-small is-right">
            <i class="fas fa-exclamation-triangle"></i>
          </span>
        </div>
        @error('email')
            <p class="text-red-500 text-xs mt-1" >{{$message}}</p>
        @enderror
      </div>

      <div class="field">
        <label class="label">Phone Number</label>
        <div class="control has-icons-left has-icons-right">
          <input class="input is-danger" type="text" name="phoneNumber" placeholder="Phone Number" value="{{ old('phoneNumber') }}">
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
          <span class="icon is-small is-right">
            <i class="fas fa-exclamation-triangle"></i>
          </span>
        </div>
        @error('phoneNumber')
            <p class="text-red-500 text-xs mt-1" >{{$message}}</p>
        @enderror
      </div>

      <div class="field">
        <label class="label">Password</label>
        <div class="control has-icons-left has-icons-right">
          <input class="input is-danger" type="password" name="password" placeholder="password" value={{ old('password') }}>
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
          <span class="icon is-small is-right">
            <i class="fas fa-exclamation-triangle"></i>
          </span>
        </div>
        @error('password')
            <p class="text-red-500 text-xs mt-1" >{{$message}}</p>
        @enderror
      </div>

      <div class="field">
        <label class="label">Password Confirmation</label>
        <div class="control has-icons-left has-icons-right">
            <input id="password" type="password" placeholder="password confirmation" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="current-password">
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
          <span class="icon is-small is-right">
            <i class="fas fa-exclamation-triangle"></i>
          </span>
        </div>
      </div>
      
       <div class="mb-6">
        <button
            class="bg-laravel text-black rounded py-2 px-4 hover:bg-red"
        >
            Create Center
        </button>

        <a href="/center" class="text-black ml-4"> Back </a>
    </div>
    </form>
=======
  <div class="bg-white flex gap-2 flex-col justify-start items-center max-w-full px-8 py-4 rounded-l-3xl ">
    <h2 class="text-4xl font-bold">
        Create New Center
    </h2>
    <div class="px-12">
        <form method="POST" action="/admin/center_creation">
            @csrf

            <!-- Name -->
            <div>
                <x-text-input placeholder="Full name" id="name" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-text-input placeholder="Email" id="email" class="block mt-1 w-full rounded-full bg-gray-100" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-text-input placeholder="Phone Number" id="phone" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="phoneNumber" :value="old('phone')" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Address -->

            <div class="grid grid-rows-2">
                <div class="grid grid-cols-3 gap-2">
                    <!-- country -->
                    <div class="mt-4">
                        <x-text-input placeholder="Country" id="country" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="country" :value="old('country')" required />
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>
                    <!-- city -->
                    <div class="mt-4">
                        <x-text-input placeholder="City" id="city" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="city" :value="old('city')" required />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>
                    <!-- zipCode -->
                    <div class="mt-4">
                        <x-text-input placeholder="Zip code" id="zipCode" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="zipCode" :value="old('zipCode')" pattern="[0-9]{5}"  required />
                        <x-input-error :messages="$errors->get('zipCode')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <!-- province -->
                    <div class="mt-4">
                        <x-text-input placeholder="Province" id="province" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="province" :value="old('province')" required />
                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                    </div>
                    <!-- street -->
                    <div class="mt-4">
                        <x-text-input placeholder="Street" id="street" class="block mt-1 w-full rounded-full bg-gray-100" type="text" name="street" :value="old('street')" required />
                        <x-input-error :messages="$errors->get('street')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="mt-4">

              <x-text-input placeholder="Password" id="password" class="block mt-1 w-full rounded-full bg-gray-100"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

              <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>

          <!-- Confirm Password -->
          <div class="mt-4">

              <x-text-input placeholder="Confirm password" id="password_confirmation" class="rounded-full bg-gray-100 block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />

              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
          </div>

            <div class="flex flex-col gap-2 justify-center items-center mt-4">
                <input type="submit" value="Create" class="btn btn-outline-danger">
            </div>
        </form>
    </div>

>>>>>>> 3362197eaf2833a8e14c478e0a43762ba912a8dd
</x-app-layout>