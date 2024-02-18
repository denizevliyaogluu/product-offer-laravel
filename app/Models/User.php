<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'addres',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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
        return 'id';
    }
}
