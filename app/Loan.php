<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'id',
        'cantidad',
        'no_pagos',
        'cuota',
        'fecha_ministracion',
        'fecha_vencimiento',
    ];
}
