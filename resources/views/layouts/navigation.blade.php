<!-- resources\views\layouts\navigation.blade.php -->
<nav x-data="{ open: false }" class="h-[7.5vh] min-h-16 bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="portrait:fixed portrait:left-0 portrait:top-0 portrait:right-0 portrait:z-10 portrait:overflow-x-scroll portrait:bg-white border-b portrait:border-gray-100 max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="portrait:hidden shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex overflow-x-auto space-x-8 portrait:pr-20 portrait:pl-4 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link id="x-nav-link-dashboard" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('elevation')" :active="request()->routeIs('elevation')">
                        {{ __('Elevation')}}
                    </x-nav-link>

                    <x-nav-link :href="route('rgeocode')" :active="request()->routeIs('rgeocode')">
                        {{ __('Rgeocoding')}}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('geocode')" :active="request()->routeIs('geocode')" class="truncate">
                        {{ __('Geocoding')}}
                    </x-nav-link>

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

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
            </div>

            
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class=" sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

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
</nav>

<!-- Hamburger -->
<div class="fixed right-0 top-0 h-[7.5vh] z-10 bg-white sm:hidden landscape:hidden flex items-center px-4">
    <x-dropdown align="right" width="48">

        <x-slot name="trigger" class=" flex items-center">
            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>

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
</div>
