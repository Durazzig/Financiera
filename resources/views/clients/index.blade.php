@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Clientes</h3>
                    </div>
                    <form action="{{route('clients.import')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(Session::has('message'))
                            <p>{{Session::get('message')}}</p>
                            @endif
                            <div class="row">
                                <div class="col">
                                    <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                                </div>
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                <div class="col">
                                    <button class="btn btn-success">Importar</button>
                                </div>
                            </div>
                    </form>
                    <div>
                        <a href="{{ route('clients.create') }}" class="btn btn-primary">
                            {{ __('Nuevo Cliente')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(Auth::user())
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Nombre') }}</th>
                            <th scope="col">{{ __('Telefono') }}</th>
                            <th scope="col" style="width: 150px">{{ __('Opciones') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td scope="row">{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>
                                <a href="{{url('/clients/edit',$client->id)}}" class="btn btn-outline-secondary btn-sm">
                                    Editar
                                </a>
                                <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{ $client->id }}">Borrar</button>
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

