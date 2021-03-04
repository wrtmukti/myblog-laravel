<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>

    <body>
        <div>
            <nav class="bg-gray-800 ">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
                    <div class="flex items-center justify-between h-16 ">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <a href="/home">
                                    <img class="h-8 w-8" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                                </a>
                            </div>

                            {{-- menu --}}
                            <div class="hidden md:block">
                                <div class="ml-10 flex items-baseline space-x-4">

                                    @yield('menu')
                                   
                                </div>
                            </div>
                        </div>

                        {{-- dropdown user --}}
                        @if (Route::has('login'))  
                                @auth
                                    {{-- notifikasi --}}
                                    <div class="hidden md:block">
                                        <div class="ml-4 flex items-center md:ml-6">
                                            <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                                <span class="sr-only">View notifications</span>
                                                <!-- Heroicon name: bell -->
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                </svg>
                                            </button>

                                            <div class="ml-3 relative">
                                                <x-jet-dropdown align="right" width="48">
                                                    <x-slot name="trigger">
                                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                                            </button>
                                                        @else
                                                            <button class="flex items-center text-sm font-medium text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">
                                                                <div>{{ Auth::user()->name }}</div>
                                
                                                                <div class="ml-1">
                                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                    </svg>
                                                                </div>
                                                            </button>
                                                        @endif
                                                    </x-slot>
                                                    
                                
                                                    <x-slot name="content">
                                                        <!-- Account Management -->
                                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                                            {{ __('Manage Account') }}
                                                        </div>
                                
                                                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                                            {{ __('Profile') }}
                                                        </x-jet-dropdown-link>
                                
                                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                                                {{ __('API Tokens') }}
                                                            </x-jet-dropdown-link>
                                                        @endif
                                                        <div class="border-t border-gray-100"></div>                                           
                                                        <!-- Authentication -->
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf
                                
                                                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                                                onclick="event.preventDefault();
                                                                                            this.closest('form').submit();">
                                                                {{ __('Logout') }}
                                                            </x-jet-dropdown-link>
                                                        </form>
                                                    </x-slot>
                                                </x-jet-dropdown>
                                            </div>
                                    </div>                        
                                    @else
                                    <div class="hidden md:block">
                                        <div class="ml-4 flex items-center md:ml-6">
                                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">Login</a>
                                            
                                        {{-- @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="text-sm font-medium text-gray-300 hover:text-white hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">Register</a>
                                        @endif --}}
                                        </div>
                                    </div>
                                </div>
                                </div>
                                @endauth                          
                        @endif
                    </div>
                </div>
            </nav>

            @yield('content')
            <footer class="px-6 py-2 bg-gray-800 text-gray-100">
                <div class="flex flex-col justify-between items-center container mx-auto md:flex-row"><a href="#"
                        class="text-2xl font-bold">Brand</a>
                    <p class="mt-2 md:mt-0">All rights reserved 2020.</p>
                    <div class="flex -mx-2 mt-4 mb-2 md:mt-0 md:mb-0"><a href="#"
                            class="mx-2 text-gray-100 hover:text-gray-400"><svg viewBox="0 0 512 512"
                                class="h-4 w-4 fill-current">
                            <path
                                d="M444.17,32H70.28C49.85,32,32,46.7,32,66.89V441.61C32,461.91,49.85,480,70.28,480H444.06C464.6,480,480,461.79,480,441.61V66.89C480.12,46.7,464.6,32,444.17,32ZM170.87,405.43H106.69V205.88h64.18ZM141,175.54h-.46c-20.54,0-33.84-15.29-33.84-34.43,0-19.49,13.65-34.42,34.65-34.42s33.85,14.82,34.31,34.42C175.65,160.25,162.35,175.54,141,175.54ZM405.43,405.43H341.25V296.32c0-26.14-9.34-44-32.56-44-17.74,0-28.24,12-32.91,23.69-1.75,4.2-2.22,9.92-2.22,15.76V405.43H209.38V205.88h64.18v27.77c9.34-13.3,23.93-32.44,57.88-32.44,42.13,0,74,27.77,74,87.64Z">
                            </path>
                        </svg></a><a href="#" class="mx-2 text-gray-100 hover:text-gray-400"><svg viewBox="0 0 512 512"
                            class="h-4 w-4 fill-current">
                            <path
                                d="M455.27,32H56.73A24.74,24.74,0,0,0,32,56.73V455.27A24.74,24.74,0,0,0,56.73,480H256V304H202.45V240H256V189c0-57.86,40.13-89.36,91.82-89.36,24.73,0,51.33,1.86,57.51,2.68v60.43H364.15c-28.12,0-33.48,13.3-33.48,32.9V240h67l-8.75,64H330.67V480h124.6A24.74,24.74,0,0,0,480,455.27V56.73A24.74,24.74,0,0,0,455.27,32Z">
                            </path>
                        </svg></a><a href="#" class="mx-2 text-gray-100 hover:text-gray-400"><svg viewBox="0 0 512 512"
                            class="h-4 w-4 fill-current">
                            <path
                                d="M496,109.5a201.8,201.8,0,0,1-56.55,15.3,97.51,97.51,0,0,0,43.33-53.6,197.74,197.74,0,0,1-62.56,23.5A99.14,99.14,0,0,0,348.31,64c-54.42,0-98.46,43.4-98.46,96.9a93.21,93.21,0,0,0,2.54,22.1,280.7,280.7,0,0,1-203-101.3A95.69,95.69,0,0,0,36,130.4C36,164,53.53,193.7,80,211.1A97.5,97.5,0,0,1,35.22,199v1.2c0,47,34,86.1,79,95a100.76,100.76,0,0,1-25.94,3.4,94.38,94.38,0,0,1-18.51-1.8c12.51,38.5,48.92,66.5,92.05,67.3A199.59,199.59,0,0,1,39.5,405.6,203,203,0,0,1,16,404.2,278.68,278.68,0,0,0,166.74,448c181.36,0,280.44-147.7,280.44-275.8,0-4.2-.11-8.4-.31-12.5A198.48,198.48,0,0,0,496,109.5Z">
                            </path>
                        </svg></a>
                    </div>
                </div>
            </footer>
            
        </div>
        
        @livewireScripts
    </body>
</html>