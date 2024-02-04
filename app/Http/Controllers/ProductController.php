<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function index(){
        $products = Products::with('getCategory')->get();
        return view('products.index', compact('products'));
    }

    public function create(){
        $categories = ProductCategories::all();
        return view('products.create', compact('categories'));
    }

    public function createPost(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:product_categories,id',
        ]);
        $product = new Products();
        $product->name = $request->name;
        $product->user_id = Auth::user()->id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->image = 1;
        $product->status = 1;
        $product->save();

    return redirect()->route('products.index')->with('success', 'Ürün başarıyla oluşturuldu.');
    }
}
