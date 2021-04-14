<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $guarded = [];

    public function Transaction()
    {
        return $this->hasOne('App\Transaction');
    }
}
