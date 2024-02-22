<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductComments extends Model
{
    protected $table = 'product_comments';

    public function getProducts(){
        return $this->hasMany(Products::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
