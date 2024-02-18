<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\ProductCategories;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $pending_orders = Orders::with('getOrderItems.getProduct.getCategory')
                ->where('status', 0)
                ->where('user_id', $user_id)
                ->get();

            $confirmed_orders = Orders::with('getOrderItems.getProduct.getCategory')
                ->where('status', 1)
                ->where('user_id', $user_id)
                ->get();

            return view('orders.index', compact('pending_orders', 'confirmed_orders'));
        } else {
            return redirect()->route('login')->with('error', 'Siparişlerinizi görmek için giriş yapmalısınız.');
        }
    }


    public function create(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Products::find($productId);

        if (Auth::check()) {
            $order = Orders::where('user_id', Auth::id())->where('status', 0)->first();

            if (!$order) {
                $order = new Orders();
                $order->user_id = Auth::id();
                $order->total_amount = 0;
                $order->status = 0; // Yeni bir sipariş oluşturulduğunda status 0 olmalı
                $order->save();
            }

            $orderItem = new OrderItems();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $productId;
            $orderItem->status = 0;
            $orderItem->save();

            // Siparişin toplam tutarını güncelle
            $order->total_amount += $product->price;
            $order->save();

            return redirect()->back()->with('success', 'Ürün sepete eklendi.');
        } else {
            return redirect()->route('login')->with('error', 'Sepete ürün eklemek için giriş yapmalısınız.');
        }
    }

    public function confirmCart()
    {
        if (Auth::check()) {
            $order = Orders::where('user_id', Auth::id())->where('status', 0)->first();

            if ($order) {
                $order->status = 1;
                $order->save();

                return redirect()->back()->with('success', 'Sepetiniz onaylandı.');
            } else {
                return redirect()->back()->with('error', 'Onaylanacak bir sepet bulunamadı.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Sepeti onaylamak için giriş yapmalısınız.');
        }
    }

}


