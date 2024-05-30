<?php

// OfferController.php
namespace App\Http\Controllers;

use App\Models\Offers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function index()
    {
        $userOffers = Offers::where('user_id', Auth::id())->get();
        return view('offers.index', compact('userOffers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'product_id' => 'required|exists:products,id',
        ]);

        Offers::create([
            'user_id' => Auth::id(),
            'product_id' => $request->input('product_id'),
            'price' => $request->input('price'),
        ]);

        return redirect()->back()->with('success', 'Teklif başarıyla verildi.');
    }
}

