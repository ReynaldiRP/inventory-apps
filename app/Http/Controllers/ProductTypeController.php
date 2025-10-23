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

    public function create(){
        return view('productType.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'type_code' => 'required|string|max:50|unique:product_types,type_code',
        'type_name' => 'required|string|max:255',
    ]);

    ProductType::create([
        'type_code' => $request->type_code,
        'type_name' => $request->type_name,
    ]);

    return redirect()
        ->route('product-types.index')
        ->with('success', 'Product Type created successfully.');
    }

    public function edit($id){
        $productType = ProductType::findOrFail($id);
        return view('productType.edit', compact('productType'));
    }

    public function update(Request $request, $id){
        $request->validate([
        'type_code' => 'required|string|max:50|unique:product_types,type_code,' . $id,
        'type_name' => 'required|string|max:255',
        ]);

        $productType = ProductType::findOrFail($id);
        $productType->update($request->only(['type_code', 'type_name']));

        return redirect()
            ->route('product-types.index')
            ->with('success', 'Product Type updated successfully.');
    }

    public function destroy($id){
        $productType = ProductType::findOrFail($id);
        $productType->delete();

        return redirect()
            ->route('product-types.index')
            ->with('success', 'Product Type deleted successfully.');
    }

}
