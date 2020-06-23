<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'id',
        'client_id',
        'cantidad',
        'no_pagos',
        'cuota',
        'fecha_ministracion',
        'fecha_vencimiento',
    ];


    public function client()
    {
        return $this->belongsTo('App\Client','client_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
