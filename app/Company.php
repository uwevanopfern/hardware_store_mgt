<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
