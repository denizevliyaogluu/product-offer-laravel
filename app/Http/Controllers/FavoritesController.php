<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function addToFavorites(Request $request)
{
    $favorite = Favorites::where('user_id', auth()->user()->id)
                         ->where('product_id', $request->product_id)
                         ->first();

    if($favorite) {
        $favorite->delete();
        return response()->json(['message' => 'Product removed from favorites'], 200);
    } else {
        $favorite = Favorites::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id
        ]);
        return response()->json(['message' => 'Product added to favorites'], 200);
    }
}

public function removeFromFavorites(Request $request)
{
    $favorite = Favorites::where('user_id', auth()->user()->id)
                         ->where('product_id', $request->product_id)
                         ->first();

    if($favorite) {
        $favorite->delete();
        return response()->json(['message' => 'Product removed from favorites'], 200);
    } else {
        $favorite = Favorites::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id
        ]);
        return response()->json(['message' => 'Product added to favorites'], 200);
    }
}

}
