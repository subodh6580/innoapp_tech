<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;


class Customer extends Model
{
    use HasFactory;
    use HasRolesAndAbilities;
    protected $primaryKey = 'id';

    public function getCustomers() {
        return $this->hasMany('App\Models\Order',"customer_id");
    }
}
