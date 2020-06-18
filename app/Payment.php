<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'client',
        'loan',
        'no_pago',
        'cantidad',
        'pago_date',
        'pago_registrado',
    ];

    public function setUpdatedAtAttribute($value)
    {
        // to Disable updated_at
    }
    public function setCreatedAtAttribute($value)
    {
        // to Disable updated_at
    }
}
