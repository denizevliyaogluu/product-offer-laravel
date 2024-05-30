<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductManagementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = $user->getProducts;
        foreach ($products as $product) {
            $firstImage = $product->images()->first();
            $product->first_image = $firstImage ? asset('images/' . $firstImage->image) : asset('images/default-image.jpg');
        }

        foreach ($products as $product) {
            $product->orders = OrderItems::whereHas('getOrder', function ($query) {
                $query->where('status', 1);
            })->where('product_id', $product->id)->with('getOrder')->get();
        }

        return view('productmanagement.index', compact('products'));
    }

    public function showOrderDetails($productId)
    {
        $product = Products::findOrFail($productId);
        $orders = OrderItems::whereHas('getOrder', function ($query) {
            $query->where('status', 1);
        })->where('product_id', $product->id)->with('getOrder')->get();
        return view('productmanagement.show_order_details', compact('product', 'orders'));
    }

    public function showOfferDetails($productId)
{
    $product = Products::findOrFail($productId);
    $offers = $product->offers; // Ürüne ait teklifleri al

    return view('productmanagement.show_offers_details', compact('product', 'offers'));
}

}
