<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $fillable = ['id','product_id', 'user_id', 'quantity'];
}
?>