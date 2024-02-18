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

    public function show($uniqid){
        $product = Products::where('uniqid', $uniqid)->firstOrFail();
        return view('products.show', compact('product'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $uniqid = uniqid();
        $product = new Products();
        $product->name = $request->name;
        $product->user_id = Auth::user()->id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->image = $imageName;
        $product->status = 1;
        $product->uniqid = $uniqid;
        $product->save();

        return redirect()->route('products.index')->with('success', 'The product was created successfully.');
    }


    public function update($uniqid){
        $product = Products::where('uniqid', $uniqid)->firstOrFail();
        $categories = ProductCategories::all();
        return view('products.update', compact('product', 'categories'));
    }

    public function updatePost(Request $request, $uniqid){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:product_categories,id',
        ]);

        $product = Products::where('uniqid', $uniqid)->firstOrFail();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect()->route('products.index')->with('success', 'The product has been updated successfully.');
    }

    public function delete($uniqid)
    {
        $product = Products::where('uniqid', $uniqid)->firstOrFail();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'The product has been deleted successfully.');
    }

}
