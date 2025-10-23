<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    public function index(){
        $productTypes = ProductType::latest()->get();
        return view('productType.index', compact('productTypes'));
    }

    public function create(Request $request){
        return view('productType.create');
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ProductType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('product-types.index')->with('success', 'Product Type created successfully.');
    }
    
    public function edit($id){
        $productType = ProductType::findOrFail($id);
        return view('productType.edit', compact('productType'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $productType = ProductType::findOrFail($id);
        $productType->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('product-types.index')->with('success', 'Product Type updated successfully.');
    }
    public function destroy($id){
        $productType = ProductType::findOrFail($id);
        $productType->delete();

        return redirect()->route('product-types.index')->with('success', 'Product Type deleted successfully.');
    }

}
