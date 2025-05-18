@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">Your Profile</h1>
            <div class="flex space-x-3">
                <a href="{{ route('profile.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                    Edit Profile
                </a>
                <a href="{{ route('profile.password') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                    Change Password
                </a>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex items-center space-x-6">
                    <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-4 h-24 w-24 flex items-center justify-center">
                        <span class="text-4xl font-bold text-blue-600 dark:text-blue-300">
                            {{ strtoupper(substr($user->username, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $user->username }}</h2>
                        <p class="text-gray-600 dark:text-gray-400">Member since {{ $user->created_at->format('F Y') }}</p>
                    </div>
                </div>
                
                <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Account Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Username</p>
                            <p class="text-base text-gray-900 dark:text-white">{{ $user->username }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Account ID</p>
                            <p class="text-base text-gray-900 dark:text-white">{{ $user->userid }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Created At</p>
                            <p class="text-base text-gray-900 dark:text-white">{{ $user->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Last Updated</p>
                            <p class="text-base text-gray-900 dark:text-white">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
