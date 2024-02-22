<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::with('getCategory')->get();
        foreach ($products as $product) {
            $firstImage = $product->images()->first();
            $product->first_image = $firstImage ? $firstImage->image : null;
        }

        return view('products.index', compact('products'));
    }

    public function show($uniqid)
{
    $product = Products::where('uniqid', $uniqid)->firstOrFail();
    $images = ProductImages::where('product_id', $product->id)->get();
    return view('products.show', compact('product', 'images'));
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
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $uniqid = uniqid();
        $product = new Products();
        $product->name = $request->name;
        $product->user_id = Auth::user()->id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->status = 1;
        $product->uniqid = $uniqid;
        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $productImage = new ProductImages();
                $productImage->product_id = $product->id;
                $productImage->image = $imageName;
                $productImage->save();
            }
        }

        return redirect()->route('productmanagement.index')->with('success', 'The product was created successfully.');
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
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }
        $product->save();

        return redirect()->route('productmanagement.index')->with('success', 'The product has been updated successfully.');
    }

    public function delete($uniqid)
    {
        $product = Products::where('uniqid', $uniqid)->firstOrFail();
        $product->delete();

        return redirect()->route('productmanagement.index')->with('success', 'The product has been deleted successfully.');
    }

}
