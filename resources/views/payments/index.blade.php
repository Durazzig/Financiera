@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-sm-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">
                            <strong>Pagos</strong>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(Auth::user())
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('#') }}</th>
                            <th scope="col">{{ __('Cliente') }}</th>
                            <th scope="col">{{ __('Cantidad') }}</th>
                            <th scope="col">{{ __('No Pagos') }}</th>
                            <th scope="col">{{ __('Cuota') }}</th>
                            <th scope="col">{{ __('Fecha Ministracion') }}</th>
                            <th scope="col">{{ __('Fecha Vencimiento') }}</th>
                            <th scope="col" style="width: 150px">{{ __('Opciones') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $loan)
                        <tr>
                            <td scope="row">{{ $loan->id }}</td>
                            <td scope="row">{{ $loan->client->name }}</td>
                            <td scope="row">{{ $loan->cantidad }}</td>
                            <td scope="row">{{ $loan->no_pagos }}</td>
                            <td scope="row">{{ $loan->cuota }}</td>
                            <td scope="row">{{ $loan->fecha_ministracion }}</td>
                            <td scope="row">{{ $loan->fecha_vencimiento }}</td>
                            <td>
                                <a href="{{url('/payments/list',$loan->id)}}" class="btn btn-outline-success btn-sm">Ver</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <strong>Se ha detetectado que no te has logueado -> Por favor inicia sesion</strong>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

