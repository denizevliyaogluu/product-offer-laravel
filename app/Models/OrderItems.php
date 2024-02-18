<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrderItems extends Model
{
    protected $table = 'order_items';

    public function getOrder(){
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    public function getProduct(){
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

}
