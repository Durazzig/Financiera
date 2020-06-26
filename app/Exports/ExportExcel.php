<?php

namespace App\Exports;

use App\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportExcel implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $loan = Loan::with('client')->orderBy('id')->get();
        return $loan;
    }

    public function map($loan) : array{
        return [
            $loan->id,
            $loan->client->name,
            $loan->cantidad,
            $loan->no_pagos,
            $loan->cuota,
            $loan->pagos_completados,
            $loan->saldo_abonado,
            $loan->saldo_pendiente,
            $loan->finalizado,
        ];
    }

    public function headings():array{
        return [
            '#',
            'Nombre',
            'Cantidad',
            'Número de Pagos',
            'Cuota',
            'Pagos Completados',
            'Saldo Abonado',
            'Saldo Pendiente',
            'Finalizado'
        ];
    }
}
