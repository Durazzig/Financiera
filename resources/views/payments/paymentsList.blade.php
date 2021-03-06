@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-sm-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>Saldo Abonado: ${{ $saldo_abonado }}</strong>
                    </div>
                    <div>
                        <strong>Saldo Pendiente: ${{ $saldo_pendiente }}</strong>
                    </div>
                    <div>
                        <strong>Deuda Total: ${{ $deuda[0]->cantidad }}</strong>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Pagos</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('#') }}</th>
                            <th scope="col">{{ __('Cliente') }}</th>
                            <th scope="col">{{ __('Prestamo') }}</th>
                            <th scope="col">{{ __('No Pago') }}</th>
                            <th scope="col">{{ __('Cantidad') }}</th>
                            <th scope="col">{{ __('Fecha De Pago') }}</th>
                            <th scope="col">{{ __('Pago Registrado ($)') }}</th>
                            <th scope="col">{{ __('Actualizacion de pago') }}</th>
                            <th scope="col">{{ __('Pagado') }}</th>
                            <th scope="col" style="width: 150px">{{ __('Opciones') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                        <tr>
                            <td scope="row">{{ $payment->id }}</td>
                            <td scope="row">{{ $payment->client->name }}</td>
                            <td scope="row">{{ $payment->loan_id }}</td>
                            <td scope="row">{{ $payment->no_pago }}</td>
                            <td scope="row">{{ $payment->cantidad }}</td>
                            <td scope="row">{{ $payment->pago_date }}</td>
                            <td scope="row">${{ $payment->pago_registrado }}</td>
                            <td scope="row">{{ $payment->updated_at }}</td>
                            <td scope="row">{{ $payment->pagado }}</td>
                            <td>
                                <a href="{{ route('payments.abonar',$payment->loan_id) }}" class="btn btn-sm btn-primary">
                                    {{ __('Abonar')}}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

