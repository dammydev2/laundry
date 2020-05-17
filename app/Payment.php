<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['tag', 'name', 'amount', 'balance', 'type', 'method'];
}
