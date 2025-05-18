<?php

namespace App\Http\Controllers;

use App\Models\Stocko;
use App\Models\Product;
use Illuminate\Http\Request;

class StockoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockos = Stocko::with(['product'])
            ->latest()
            ->paginate(10);
        return view('stocko.index', compact('stockos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('stocko.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'productid' => 'required|exists:products,productid',
            'stockodate' => 'required|date|before_or_equal:today',
            'quantity' => 'required|integer|min:1',
            'unitprice' => 'required|numeric|min:0',
            'customer' => 'required|string|max:255',
        ]);

        $credentials['totalprice'] = $credentials['quantity'] * $credentials['unitprice'];
        Stocko::create($credentials);
        return redirect()->route('stocko.index')->with('success', 'Stock out created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stocko $stocko)
    {
        return view('stocko.show', compact('stocko'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stocko $stocko)
    {
        $products = Product::all();
        return view('stocko.edit', compact('stocko', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stocko $stocko)
    {
        $credentials = $request->validate([
            'productid' => 'required|exists:products,productid',
            'stockodate' => 'required|date|before_or_equal:today',
            'quantity' => 'required|integer|min:1',
            'unitprice' => 'required|numeric|min:0',
            'customer' => 'required|string|max:255',
        ]);

        $credentials['totalprice'] = $credentials['quantity'] * $credentials['unitprice'];
        $stocko->update($credentials);
        return redirect()->route('stocko.index')->with('success', 'Stock out updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stocko $stocko)
    {
        $stocko->delete();
        return redirect()->route('stocko.index')->with('success', 'Stock out deleted successfully');
    }
}

