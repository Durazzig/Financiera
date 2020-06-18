<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'id',
        'cliente',
        'cantidad',
        'no_pagos',
        'cuota',
        'fecha_ministracion',
        'fecha_vencimiento',
    ];

    public function setUpdatedAtAttribute($value)
    {
        // to Disable updated_at
    }
    public function setCreatedAtAttribute($value)
    {
        // to Disable updated_at
    }

    public function client()
    {
        return $this->belongsTo('App\Client','client_id');
    }
}
