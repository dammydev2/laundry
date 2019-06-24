<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddColor extends Model
{
    protected $fillable = ['tag', 'category', 'color', 'qty'];
}
