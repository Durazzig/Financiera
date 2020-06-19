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
                    <div>
                        <a href="{{ route('payments.abonar') }}" class="btn btn-primary">
                            {{ __('Abonar')}}
                        </a>
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
                            <td scope="row">{{ $payment->pago_registrado }}</td>
                            <td>
                            <button class="btn btn-outline-danger btn-sm btn-delete" data-id="">Borrar</button>
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
                axios.delete('{{ route('clients.index') }}/' + id)
                    .then(result => {
                        Swal.fire({
                            title: 'Borrado',
                            text: 'El cliente a sido borrado',
                            icon: 'success'
                        }).then(() => {
                            window.location.href='{{ route('clients.index') }}';
                        });
                    })
                    .catch(error => {
                        Swal.fire(
                            'Ocurrió un error',
                            'El cliente no ha podido borrarse.',
                            'error'
                        );
                    });

            }
        });
    });
</script>
@endsection

