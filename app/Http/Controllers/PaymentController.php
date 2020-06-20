<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Loan;
use App\Client;
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
    public function update(Request $request,$id)
    {
        $payments = Payment::all()->where('loan_id',$id);
        $pago = $request->input('quantity');
        $aux = $request->input('quantity');
        foreach($payments as $payment)
        {
            //Cuando pago justo lo que pide la cuota
            if($payment->pago_registrado == 0)
            {
                if($pago == ($payment->cantidad))
                {
                    $payment->pago_registrado = $pago;
                    $payment->save();
                    $pago = 0;
                }
                //Cuando pago mas de lo que pide la cuota
                elseif($pago > $payment->cantidad)
                {
                    $pago = $payment->cantidad;
                    $payment->pago_registrado = $pago;
                    $payment->save();
                    $pago = $aux - $payment->cantidad;
                    $aux = $aux - $payment->cantidad;
                }
                elseif($pago < $payment->cantidad)
                {
                    $payment->pago_registrado = $pago;
                    $payment->save();
                    $pago = 0;
                }
            }
            elseif(($payment->pago_registrado > 0) && ($payment->pago_registrado < $payment->cantidad))
            {
                if($pago < $payment->cantidad)
                {
                    $subcantidad = $payment->cantidad - $payment->pago_registrado;
                    $pago = $pago - $subcantidad;
                    $payment->pago_registrado = $payment->cantidad;
                    $payment->save();
                }
                elseif($pago > $payment->cantidad)
                {

                }
            }
        }
        $saldo_abonado = 0;
        $saldo_pendiente = 0;
        $deuda = Loan::select('cantidad')->where('id',$id)->get();
        foreach($payments as $payment)
        {
            $saldo_abonado += $payment->pago_registrado;
            $saldo_pendiente = $deuda[0]->cantidad - $saldo_abonado;
        }
        //dd($loans->id);
        return view('payments.paymentsList',compact('payments'))->with(compact('deuda','saldo_abonado','saldo_pendiente'));
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
        return view('payments.paymentsList',compact('payments'))->with(compact('deuda','saldo_abonado','saldo_pendiente'));
    }

    public function abonar($id)
    {
        //dd($id);
        $loans = Payment::all()->where('loan_id',$id)->first();
        //dd($loans->id);
        return view('payments.abonar',compact('loans'));
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
