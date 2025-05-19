<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stock Management') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    <style>
        [x-cloak] { display: none !important; }

        /* Animation classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        .slide-in {
            animation: slideIn 0.3s ease-in-out;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Transition classes */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-md hidden md:block">
            <!-- User Profile Section -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                        <span class="text-lg font-bold text-blue-600 dark:text-blue-300">
                            {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold text-gray-800 dark:text-white">{{ Auth::user()->username }}</h2>
                        <a href="{{ route('profile.show') }}" class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Logo Section -->
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Stock Manager</h1>
            </div>

            <!-- Navigation -->
            <nav class="mt-2 pb-20"> <!-- Added pb-20 to prevent overlap with fixed logout -->
                <h3 class="px-6 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Main Navigation
                </h3>

                <div class="mt-3 px-4 py-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </div>

                <h3 class="mt-6 px-6 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Inventory Management
                </h3>

                <div class="mt-3 px-4 py-2">
                    <a href="{{ route('products.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('products.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span>Products</span>
                    </a>
                </div>

                <div class="px-4 py-2">
                    <a href="{{ route('products.create') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('products.create') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Add Product</span>
                    </a>
                </div>

                <h3 class="mt-6 px-6 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Stock Transactions
                </h3>

                <div class="mt-3 px-4 py-2">
                    <a href="{{ route('stocki.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('stocki.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Stock In</span>
                    </a>
                </div>

                <div class="px-4 py-2">
                    <a href="{{ route('stocko.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('stocko.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Stock Out</span>
                    </a>
                </div>
            </nav>

            <!-- Bottom Section (Logout Button) -->
            <div class="fixed bottom-0 left-0 w-64 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 z-10">
                <div class="px-4 py-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-red-600 dark:text-red-400">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile menu button -->
        <div class="md:hidden fixed top-0 left-0 z-50 p-4">
            <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="fixed inset-0 z-40 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">
            <div class="bg-white dark:bg-gray-800 h-full w-64 shadow-lg overflow-y-auto pb-20"> <!-- Added pb-20 to prevent overlap -->
                <div class="flex justify-end p-4">
                    <button id="close-mobile-menu" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- User Profile Section -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                            <span class="text-lg font-bold text-blue-600 dark:text-blue-300">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-white">{{ Auth::user()->username }}</h2>
                            <a href="{{ route('profile.show') }}" class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Logo Section -->
                <div class="p-4">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Stock Manager</h1>
                </div>

                <!-- Navigation -->
                <nav class="mt-2">
                    <h3 class="px-6 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Main Navigation
                    </h3>

                    <div class="mt-3 px-4 py-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </div>

                    <h3 class="mt-6 px-6 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Inventory Management
                    </h3>

                    <div class="mt-3 px-4 py-2">
                        <a href="{{ route('products.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('products.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span>Products</span>
                        </a>
                    </div>

                    <div class="px-4 py-2">
                        <a href="{{ route('products.create') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('products.create') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Add Product</span>
                        </a>
                    </div>

                    <h3 class="mt-6 px-6 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Stock Transactions
                    </h3>

                    <div class="mt-3 px-4 py-2">
                        <a href="{{ route('stocki.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('stocki.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Stock In</span>
                        </a>
                    </div>

                    <div class="px-4 py-2">
                        <a href="{{ route('stocko.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 {{ request()->routeIs('stocko.*') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Stock Out</span>
                        </a>
                    </div>
                </nav>

                <!-- Bottom Section (Logout Button) -->
                <div class="fixed bottom-0 left-0 w-64 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 z-10">
                    <div class="px-4 py-6">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-red-600 dark:text-red-400">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-black bg-opacity-50 h-full w-screen" id="mobile-menu-overlay"></div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-gray-900">
            <!-- Top Header -->
            <header class="bg-white dark:bg-gray-800 shadow-sm">
                <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <button id="mobile-menu-button-alt" class="md:hidden text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600 mr-4">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">@yield('title', 'Dashboard')</h2>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button id="dark-mode-toggle" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition duration-200">
                            <!-- Sun icon (shown in dark mode) -->
                            <svg id="sun-icon" class="h-5 w-5 text-gray-700 dark:text-yellow-300 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <!-- Moon icon (shown in light mode) -->
                            <svg id="moon-icon" class="h-5 w-5 text-gray-700 dark:text-gray-300 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </button>

                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                                <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-1 h-8 w-8 flex items-center justify-center">
                                    <span class="text-sm font-bold text-blue-600 dark:text-blue-300">
                                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                    </span>
                                </div>
                                <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" x-cloak
                                 class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Your Profile
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Edit Profile
                                </a>
                                <a href="{{ route('profile.password') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Change Password
                                </a>
                                <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="container mx-auto px-6 py-8">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 fade-in" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3 focus:outline-none" onclick="this.parentElement.style.display='none'">
                            <svg class="h-4 w-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 fade-in" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <button class="absolute top-0 bottom-0 right-0 px-4 py-3 focus:outline-none" onclick="this.parentElement.style.display='none'">
                            <svg class="h-4 w-4 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu functionality
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenuButtonAlt = document.getElementById('mobile-menu-button-alt');
            const closeMobileMenuButton = document.getElementById('close-mobile-menu');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

            function openMobileMenu() {
                mobileMenu.classList.remove('-translate-x-full');
                document.body.classList.add('overflow-hidden');
            }

            function closeMobileMenu() {
                mobileMenu.classList.add('-translate-x-full');
                document.body.classList.remove('overflow-hidden');
            }

            mobileMenuButton.addEventListener('click', openMobileMenu);
            if (mobileMenuButtonAlt) {
                mobileMenuButtonAlt.addEventListener('click', openMobileMenu);
            }

            closeMobileMenuButton.addEventListener('click', closeMobileMenu);
            mobileMenuOverlay.addEventListener('click', closeMobileMenu);

            // Dark mode toggle functionality
            const darkModeToggle = document.getElementById('dark-mode-toggle');
            const html = document.documentElement;

            // Check for saved theme preference or use the system preference
            const savedTheme = localStorage.getItem('theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }

            // Toggle dark mode
            darkModeToggle.addEventListener('click', function() {
                html.classList.toggle('dark');

                // Save preference to localStorage
                if (html.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                    darkModeToggle.classList.add('rotate-animation');
                } else {
                    localStorage.setItem('theme', 'light');
                    darkModeToggle.classList.add('rotate-animation');
                }

                // Remove animation class after animation completes
                setTimeout(() => {
                    darkModeToggle.classList.remove('rotate-animation');
                }, 500);
            });

            // Add animation for dark mode toggle
            darkModeToggle.classList.add('transition-transform', 'duration-500');

            // Add rotate animation class
            const style = document.createElement('style');
            style.textContent = `
                .rotate-animation {
                    animation: rotate-toggle 0.5s ease-in-out;
                }

                @keyframes rotate-toggle {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            `;
            document.head.appendChild(style);

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 1s ease-out';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 1000);
                }, 5000);
            });
        });
    </script>
</body>
</html>