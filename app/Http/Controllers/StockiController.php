<?php

namespace App\Http\Controllers;

use App\Models\Stocki;
use App\Models\Product;
use Illuminate\Http\Request;

class StockiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockis = Stocki::with(['product'])
        ->latest()
        ->paginate(10);
        return view('stocki.index', compact('stockis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('stocki.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'productid' => 'required|exists:products,productid',
            'stockidate' => 'required|date|before_or_equal:today',
            'quantity' => 'required|integer|min:1',
            'unitprice' => 'required|numeric|min:0',
            'totalprice' => 'required|numeric|min:0',
        ]);

        $credentials['totalprice'] = $credentials['quantity'] * $credentials['unitprice'];
        Stocki::create($credentials);
        return redirect()->route('stocki.index')->with('success', 'Stockin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stocki $stocki)
    {
        return view('stocki.show', compact('stocki'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stocki $stocki)
    {
        $products = Product::all();
        return view('stocki.edit', compact('stocki', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stocki $stocki)
    {
        $credentials = $request->validate([
            'productid' => 'required|exists:products,productid',
            'stockidate' => 'required|date|before_or_equal:today',
            'quantity' => 'required|integer|min:1',
            'unitprice' => 'required|numeric|min:0',
            'totalprice' => 'required|numeric|min:0'
        ]);

        $credentials['totalprice'] = $credentials['quantity'] * $credentials['unitprice'];
        $stocki->update($credentials);
        return redirect()->route('stocki.index')->with('success', 'Stockin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stocki $stocki)
    {
        $stocki->delete();
        return redirect()->route('stocki.index')->with('success', ' Stockin Deleted successfully');
    }
}
