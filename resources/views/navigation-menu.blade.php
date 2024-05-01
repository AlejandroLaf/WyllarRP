<nav class="flex items-center justify-between py-3 px-6 border-b border-gray-100" style="background-color: #22CC7C">
    <div id="nav-left" class="flex items-center">
        <a href=" {{ route('home') }}">
            <x-application-mark />
        </a>
        <div class="top-menu ml-10">
            <div class="flex space-x-8 justify-between">

                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    Campañas
                </x-nav-link>

                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    Personajes
                </x-nav-link>

                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    Manual
                </x-nav-link>

            </div>
        </div>
    </div>
    <div id="nav-right" class="flex items-center md:space-x-6">
        @auth
            @include('layouts.partials.header-right-auth')
        @else
            @include('layouts.partials.header-right-guest')
        @endauth
    </div>
