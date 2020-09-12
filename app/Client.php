<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
