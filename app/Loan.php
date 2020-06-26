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

    public function getSaldoAbonadoAttribute()
    {
        return $this->payments()->sum('pago_registrado');
    }

    public function getSaldoPendienteAttribute()
    {
        $saldoPendiente = $this->payments()->sum('cantidad') - $this->saldoAbonado;
        return $saldoPendiente;
    }

    public function getPagosCompletadosAttribute()
    {
        return $this->payments()->where('pagado',1)->count();   
    }

    public function getFinalizadoAttribute()
    {
        $saldoPendiente = $this->payments()->sum('cantidad') - $this->saldoAbonado;
        if($saldoPendiente == 0)
        {
            $finalizado = "Si";
            return $finalizado;
        }else
        {
            $finalizado = "No";
            return $finalizado;
        }
    }
}
