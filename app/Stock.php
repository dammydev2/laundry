<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['name', 'cus_id', 'tag', 'category', 'qty', 'exp', 'fold', 'price', 'info', 'addamount', 'collect_date', 'discount', 'location', 'servicetype', 'totalCloth'];
}
