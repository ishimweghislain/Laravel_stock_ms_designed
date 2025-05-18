@extends('layouts.app')

@section('title', 'Edit Stock Out')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">Edit Stock Out</h1>
        <a href="{{ route('stocko.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md">
            Back to Stock Out
        </a>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <form action="{{ route('stocko.update', $stocko) }}" method="POST" class="p-6" id="stockoForm">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="productid" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product</label>
                <select name="productid" id="productid" required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->productid }}" {{ old('productid', $stocko->productid) == $product->productid ? 'selected' : '' }}>
                            {{ $product->pname }} ({{ $product->pcode }})
                        </option>
                    @endforeach
                </select>
                @error('productid')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="stockodate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date</label>
                <input type="date" name="stockodate" id="stockodate" value="{{ old('stockodate', $stocko->stockodate->format('Y-m-d')) }}" required
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                @error('stockodate')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $stocko->quantity) }}" required min="1"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                @error('quantity')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="unitprice" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Unit Price</label>
                <input type="number" name="unitprice" id="unitprice" value="{{ old('unitprice', $stocko->unitprice) }}" required min="0" step="0.01"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                @error('unitprice')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="customer" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Customer (Optional)</label>
                <input type="text" name="customer" id="customer" value="{{ old('customer', $stocko->customer) }}"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                @error('customer')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="totalprice" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Total Price</label>
                <input type="number" name="totalprice" id="totalprice" value="{{ old('totalprice', $stocko->totalprice) }}" required min="0" step="0.01" readonly
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white bg-gray-100 dark:bg-gray-600">
                @error('totalprice')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                    Update Stock Out
                </button>
            </div>
        </form>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const unitPriceInput = document.getElementById('unitprice');
            const totalPriceInput = document.getElementById('totalprice');
            
            function calculateTotal() {
                const quantity = parseFloat(quantityInput.value) || 0;
                const unitPrice = parseFloat(unitPriceInput.value) || 0;
                const total = quantity * unitPrice;
                totalPriceInput.value = total.toFixed(2);
            }
            
            quantityInput.addEventListener('input', calculateTotal);
            unitPriceInput.addEventListener('input', calculateTotal);
            
            // Initial calculation
            calculateTotal();
        });
    </script>
@endsection
