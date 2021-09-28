<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $fillable = ['id', 'score'];
}
