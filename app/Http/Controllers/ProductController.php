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

    public function show($id){
        $product = Products::findOrFail($id);
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

        $product = new Products();
        $product->name = $request->name;
        $product->user_id = Auth::user()->id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->image = $imageName;
        $product->status = 1;
        $product->save();

        return redirect()->route('products.index')->with('success', 'The product was created successfully.');
    }


    public function update($id){
        $product = Products::findOrFail($id);
        $categories = ProductCategories::all();
        return view('products.update', compact('product', 'categories'));
    }

    public function updatePost(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:product_categories,id',
        ]);

        $product = Products::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect()->route('products.index')->with('success', 'The product has been updated successfully.');
    }

    public function delete($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'The product has been deleted successfully.');
    }

}
