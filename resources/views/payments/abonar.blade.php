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
                <form action="{{ route('payments.update') }}" method="POST">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-12">
                            <label for="name">{{ __('Cantidad a abonar:') }}</label>
                            <input type="number" name="name" id="name" class="form-control">
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

