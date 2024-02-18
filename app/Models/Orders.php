<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Orders extends Model
{
    protected $table = 'orders';

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getOrderItems(){
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }

}
