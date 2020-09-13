<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
