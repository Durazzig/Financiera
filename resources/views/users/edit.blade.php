@extends('layouts.app')

@section('content')
<div class="row  ">
    <div class="col-sm-8 col-md-8 col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3><strong>Editar Perfil</strong></h3>
                    </div>
                    <div class="">
                        <a href="{{ route('clients.index') }}" class="btn btn-danger">Regresar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if( session('message'))
                <div class="alert alert-success" role="alert" id="alert">
                    {{ session('message')}}
                </div>
                @endif
            <form method="POST" action="{{ route('users.update') }}">
                    @csrf
                    <div class="form-group form-row">
                        <div class=" col-md-6">
                            <label for="name">Nombre</label>
                            <input value="{{ Auth::user()->name }}" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">   
                        <div class="col-md-6">
                            <label for="phone">Correo</label>
                            <input value="{{ Auth::user()->email  }}" type="email" name="email" id="email"class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success btn-lg">Actualizar</button>
                    </div>
                </form>

                <form method="POST" action="{{ route('users.update_pass') }}">
                    @csrf
                    <div class="form-group form-row">
                        <div class=" col-md-6">
                            <label for="name">Contraseña actual</label>
                            <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror">
                            @error('old_password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">   
                        <div class="col-md-6">
                            <label for="password">Contraseña nueva</label>
                            <input  type="password" name="password" id="new_password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-row">   
                        <div class="col-md-6">
                            <label for="phone">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success btn-lg">Actualizar</button>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
