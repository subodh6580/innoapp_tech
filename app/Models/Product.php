<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function orderItems() {
        return $this->hasMany('App\Models\Order_item',"product_id");
    }
    
}
