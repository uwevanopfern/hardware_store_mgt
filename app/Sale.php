<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
