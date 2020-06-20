@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{ __('Nuevo Abono') }}</h3>
                    </div>
                    <div>
                        <a href="{{ route('payments.index') }}" class="btn btn-danger">
                            {{ __('Regresar')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(Auth::user())
                <form action="{{ route('payments.update',$loans->loan_id) }}" method="POST">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-12">
                            <label for="client">{{ __('Cliente:') }}</label>
                            <select class="custom-select" name="client" id="client">
                                <option value="{{$loans->client_id}}">{{$loans->client->name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-12">
                            <label for="loan">{{ __('Id Prestamo:') }}</label>
                            <select class="custom-select" name="loan" id="loan">
                                <option value="{{$loans->loan_id}}">{{$loans->loan_id}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-12">
                            <label for="quantity">{{ __('Cantidad a abonar:') }}</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" selected>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success btn-lg bg-dark">{{ __('Abonar') }}</button>
                    </div>
                </form>
                @else
                    <strong>Se ha detetectado que no te has logueado -> Por favor inicia sesion</strong>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

