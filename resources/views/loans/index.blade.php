@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-sm-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Prestamos</h3>
                    </div>
                    <div>
                        <a href="{{ route('loans.export') }}" class="btn btn-primary">
                            {{ __('Exportar Prestamos')}}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('loans.create') }}" class="btn btn-primary">
                            {{ __('Nuevo Prestamo')}}
                        </a>
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
                            <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{$loan->id}}">Borrar</button>
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

@section('bottom-js')
<script>
    $('body').on('click', '.btn-delete', function(event) {
        const id = $(this).data('id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'No podrás revertir esta acción',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borralo!'
        })
        .then((result) => {
            if (result.value) {
                axios.delete('{{ route('loans.index') }}/' + id)
                    .then(result => {
                        Swal.fire({
                            title: 'Borrado',
                            text: 'El prestamo a sido borrado',
                            icon: 'success'
                        }).then(() => {
                            window.location.href='{{ route('loans.index') }}';
                        });
                    })
                    .catch(error => {
                        Swal.fire(
                            'Ocurrió un error',
                            'El prestamo no ha podido borrarse, aun tiene prestamos pendientes.',
                            'error'
                        );
                    });

            }
        });
    });
</script>
@endsection

