<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddService extends Model
{
    protected $fillable = ['service', 'qty', 'tag', 'price'];
}
