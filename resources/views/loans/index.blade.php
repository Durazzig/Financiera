@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Prestamos</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <form action="">
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="client">Cliente:</label>
                            <input class="form-control" type="text" name="client" id="client">
                        </div>
                        <div class="col-md-6">
                            <label for="client">Cantidad:</label>
                            <input class="form-control" type="text" name="client" id="client">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="client">Numero de pagos:</label>
                            <select class="btn-block" name="payments" id="payments">
                                @for ($i = 1; $i <= 100; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <!-- <input class="form-control" type="text" name="client" id="client">-->
                        </div>
                        <div class="col-md-6">
                            <label for="client">Cuota:</label>
                            <input class="form-control" type="text" name="client" id="client">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="firstDate">Fecha Ministracion:</label>
                            <input class="form-control" type="date" name="firstDate" id="firstDate">
                        </div>
                        <div class="col-md-6">
                            <label for="client">Fecha Vencimiento:</label>
                            <input class="form-control" type="date" name="client" id="client">
                        </div>
                    </div>
                <input class="btn btn-success btn-block" type="submit" value="Realizar Prestamo">
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#firstDate').click(function(){
            alert("Actualizando fecha limite")
        });
    })''
</script>
@endsection