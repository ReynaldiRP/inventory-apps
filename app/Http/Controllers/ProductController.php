<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create(){
        $productTypes = ProductType::all();
        return view('products.create', compact('productTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:products,code',
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:product_types,id',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'type_id' => $request->type_id,
            'unit' => $request->unit,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $productTypes = ProductType::all();
        return view('products.edit', compact('product', 'productTypes'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'code' => 'required|string|max:50|unique:products,code,' . $id,
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:product_types,id',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only([
            'code', 'name', 'type_id', 'unit', 'stock', 'price'
        ]));
        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
