@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">Add New Product</h1>
        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md">
            Back to Products
        </a>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <form action="{{ route('products.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="mb-6">
                <label for="pname" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Name</label>
                <input type="text" name="pname" id="pname" value="{{ old('pname') }}" required
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                @error('pname')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="pcode" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Code</label>
                <input type="text" name="pcode" id="pcode" value="{{ old('pcode') }}" required
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                @error('pcode')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                    Save Product
                </button>
            </div>
        </form>
    </div>
@endsection
