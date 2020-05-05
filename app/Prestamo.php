<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    //
    protected $table = 'prestamos';

    protected $fillable = ['cliente','cantidad','no_pagos','cuota','pago_total','fecha_ministracion','fecha_vencimiento'];
}