<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receipts = Receipt::with('product', 'user')->get();
        return view('receipts.index', compact('receipts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('receipts.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receipt_number' => 'required|unique:receipts,receipt_number',
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'type' => 'required|in:in,out',
        ]);

        Receipt::create($request->all());

        return redirect()->route('receipts.index')
            ->with('success', 'Receipt created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receipt $receipt)
    {
        $users = User::all();
        $products = Product::all();

        return view('receipts.edit', compact('receipt', 'users', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receipt $receipt)
    {
        $request->validate([
            'receipt_number' => 'required|unique:receipts,receipt_number,' . $receipt->id,
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'type' => 'required|in:in,out',
        ]);

        $receipt->update($request->all());

        return redirect()->route('receipts.index')
            ->with('success', 'Receipt updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        $receipt->delete();

        return redirect()->route('receipts.index')
            ->with('success', 'Receipt deleted successfully.');
    }
}
