<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'client_id',
        'loan_id',
        'no_pago',
        'cantidad',
        'pago_date',
        'pago_registrado',
        'pagado',
    ];


    public function loan()
    {
        return $this->belongsTo('App\Loan');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
