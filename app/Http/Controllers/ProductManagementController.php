<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductManagementController extends Controller
{
    public function index()
    {
        // Kullanıcının ürünlerini al
        $products = Auth::user()->getProducts;

        // Her ürünün siparişlerini al
        foreach ($products as $product) {
            // Ürünün siparişlerini al (status'u 1 olanlar)
            $product->orders = OrderItems::whereHas('getOrder', function ($query) {
                $query->where('status', 1);
            })->where('product_id', $product->id)->with('getOrder')->get();
        }

        return view('productmanagement.index', compact('products'));
    }
}
