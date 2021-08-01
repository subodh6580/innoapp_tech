<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';

    public function orderItems() {
        return $this->hasMany('App\Models\Order_item',"order_id");
    }

    public function customer() {
        return $this->belongsTo('App\Models\Customer',"customer_id");
    }

}


