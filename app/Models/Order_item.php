<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function order() {
        return $this->belongsTo('App\Models\Order',"order_id");
    }

    public function product() {
        return $this->belongsTo('App\Models\Product',"product_id");
    }
}
