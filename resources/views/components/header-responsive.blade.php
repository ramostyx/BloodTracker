<nav x-data="{ open: false }"
     class="max-w-7xl px-6 block mx-auto flex items-center justify-between bg-white rounded-full py-2 px-2 shadow-lg">

    <x-application-logo/>
    <div class="hidden sm:flex">

        <a class="px-4 py-2 font-sans font-semibold text-gray-700 rounded-lg hover:bg-red-500 hover:text-white"
           href="{{route('home')}}">Home</a>
        <a class="px-4 py-2 font-sans font-semibold text-gray-700 rounded-lg hover:bg-red-500 hover:text-white"
           href="{{route('categories')}}">Categories</a>
       @Role('admin')
        <a class="px-4 py-2 font-sans font-semibold text-gray-700 rounded-lg hover:bg-red-500 hover:text-white" href="/admin">Admin</a>
        @endRole
        <a class="px-4 py-2 font-sans font-semibold text-gray-700 rounded-lg hover:bg-red-500 hover:text-white" href="#">About Us</a>
    </div>
    <div>
        <div class="hidden sm:flex sm:items-center sm:ml-6">

            @auth
                @Role('center')
                    @if(\Illuminate\Support\Facades\Auth::user()->unreadNotifications->where('type','App\Notifications\LowBloodStockWarning')->isNotEmpty())
                        <x-dropdown align="right" width="96">
                            <x-slot name="trigger">
                                <button class="bg-none px-2">
                                    <ion-icon class="text-lg" name="warning"></ion-icon>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @foreach(\Illuminate\Support\Facades\Auth::user()->unreadNotifications->where('type','App\Notifications\LowBloodStockWarning') as $notification)
                                    <x-dropdown-link >
                                        {{ $notification->data['message']}}
                                    </x-dropdown-link>
                                @endforeach
                            </x-slot>
                        </x-dropdown>
                   @endif
                @endRole
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('notifications')">
                            {{ __('Notifications') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @Role('center')
                        <x-dropdown-link :href="route('bloodStock')">
                            {{ __('Blood Stock') }}
                        </x-dropdown-link>
                        @endRole

                        @Role('admin')
                        <x-dropdown-link :href="route('admin.dashboard')">
                            {{ __('Users') }}
                        </x-dropdown-link>
                        @endRole

                        @Role('donor')
                        <x-dropdown-link :href="route('donor.history')">
                            {{ __('Donations history') }}
                        </x-dropdown-link>
                        @endRole


                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif

            @endauth
        </div>

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        @auth
            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                                   onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </div>
</nav>

