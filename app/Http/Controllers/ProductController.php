<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return view('product.index', compact('products'));
    }

    public function create(){
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'type_code' => 'required|string|max:50|unique:product_types,type_code',
        'type_name' => 'required|string|max:255',
    ]);

    Product::create([
        'type_code' => $request->type_code,
        'type_name' => $request->type_name,
    ]);

    return redirect()
        ->route('product.index')
        ->with('success', 'Product created successfully.');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $id){
        $request->validate([
        'type_code' => 'required|string|max:50|unique:product_types,type_code,' . $id,
        'type_name' => 'required|string|max:255',
        ]);

        $productType = ProductType::findOrFail($id);
        $productType->update($request->only(['type_code', 'type_name']));

        return redirect()
            ->route('product.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', 'Product deleted successfully.');
    }
}
