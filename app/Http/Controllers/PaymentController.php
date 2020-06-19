<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Loan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::all();
        return view('payments.index',compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pays = Payment::all();
    }

    public function list($id)
    {
        $payments = Payment::all()->where('loan_id',$id);
        $saldo_abonado = 0;
        $saldo_pendiente = 0;
        $deuda = Loan::select('cantidad')->where('id',$id)->get();
        foreach($payments as $payment)
        {
            $saldo_abonado += $payment->pago_registrado;
            $saldo_pendiente = $deuda[0]->cantidad - $saldo_abonado;
        }
        //dd($deuda);
        return view('payments.paymentsList',compact('payments'))->with(compact('deuda','saldo_abonado','saldo_pendiente'));
    }

    public function abonar(Request $request)
    {
        return view('payments.abonar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
