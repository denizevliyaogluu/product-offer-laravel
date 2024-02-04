<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'users';

    public function getProducts()
    {
        return $this->hasMany(Products::class);
    }

    public function getOrders()
    {
        return $this->hasMany(Orders::class);
    }

    public function getAuthIdentifierName()
    {
        return 'id'; // ya da kullanıcı için belirlenmiş bir başka alan adı
    }

}
