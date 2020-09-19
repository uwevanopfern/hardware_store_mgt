<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
