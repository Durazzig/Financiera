<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use App\Client;
use App\Payment;
use Carbon\Carbon;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::all();
        return view('loans.index',compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientsData = Client::all();
        return view('loans.create',compact('clientsData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loan = new Loan();
        $loan->client_id = $request->input('client');
        $loan->cantidad = $request->input('quantity');
        $loan->no_pagos = $request->input('payments');
        $loan->cuota = $request->input('cuota');
        $loan->fecha_ministracion = $request->input('firstDate');
        $loan->fecha_vencimiento = $request->input('lastDate');
        $loan->save();
        $fecha = Carbon::createFromDate($request->firstDate);
        $contador_pagos = 0;
        while($contador_pagos < $loan->no_pagos)
        {
            $fecha -> addDay();
            if($fecha->isWeekDay())
            {
                $payment = new Payment();
                $payment->client_id = $loan->client_id;
                $payment->loan_id = $loan->id;
                $payment->no_pago = $contador_pagos + 1;
                $payment->cantidad = $loan->cuota;
                $payment->pago_date = $fecha;
                $payment->pago_registrado = 0;
                $payment->save();
                $contador_pagos++;
            }
        }
        $loans = Loan::all();
        return view('loans.index',compact('loans'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
