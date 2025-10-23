<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    public function index(){
        $productTypes = ProductType::latest()->get();
        return view('product_types.index', compact('productTypes'));
    }
    
    public function create(){
        return view('product_types.create');
    }

}
