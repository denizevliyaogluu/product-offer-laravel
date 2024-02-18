<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductManagementController extends Controller
{
    public function index()
    {
        $products = Auth::user()->getProducts;
        return view('productmanagement.index', compact('products'));
    }
}
