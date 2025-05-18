@extends('layouts.app')

@section('title', 'View Stock In')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">Stock In Details</h1>
        <a href="{{ route('stocki.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md">
            Back to Stock In
        </a>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Stock In Information</h2>
                    
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</p>
                        <p class="text-base text-gray-900 dark:text-white">{{ $stocki->stockiid }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</p>
                        <p class="text-base text-gray-900 dark:text-white">{{ $stocki->stockidate->format('F d, Y') }}</p>
                    </div>
                </div>
                
                <div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Product Information</h2>
                    
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Product Name</p>
                        <p class="text-base text-gray-900 dark:text-white">{{ $stocki->product->pname }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Product Code</p>
                        <p class="text-base text-gray-900 dark:text-white">{{ $stocki->product->pcode }}</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Transaction Details</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Unit Price</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Price</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $stocki->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">${{ number_format($stocki->unitprice, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">${{ number_format($stocki->totalprice, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('stocki.edit', $stocki) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                    Edit
                </a>
                <form action="{{ route('stocki.destroy', $stocki) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this stock in record?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
