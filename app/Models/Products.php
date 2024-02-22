<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    public function getUser()
    {
        return $this->hasOne(User::class);
    }

    public function getCategory()
    {
        return $this->belongsTo(ProductCategories::class, 'category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function comments()
    {
        return $this->hasMany(ProductComments::class, 'product_id');
    }


}
