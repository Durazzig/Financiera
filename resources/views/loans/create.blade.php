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
                    <div>
                        <a href="{{ route('clients.index') }}" class="btn btn-danger">
                            {{ __('Regresar')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            @if(Auth::user())
            <form action="{{route('loans.store')}}">
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="client">Cliente:</label>
                            <select class="custom-select" name="client" id="client">
                                @foreach($clientsData as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="quantity">Cantidad:</label>
                            <input class="form-control" type="number" name="quantity" id="quantity">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="payments">Numero de pagos:</label>
                            <select class="custom-select" name="payments" id="payments">
                                @for ($i = 1; $i <= 100; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <!-- <input class="form-control" type="text" name="client" id="client">-->
                        </div>
                        <div class="col-md-6">
                            <label for="cuota">Cuota:</label>
                            <input class="form-control" type="number" name="cuota" id="cuota">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="firstDate">Fecha Ministracion:</label>
                            <input class="form-control" type="date" name="firstDate" id="firstDate">
                        </div>
                        <div class="col-md-6">
                            <label for="lastDate">Fecha Vencimiento:</label>
                            <input class="form-control" type="date" name="lastDate" id="lastDate">
                        </div>
                    </div>  
                <input class="btn btn-success btn-block bg-dark" type="submit" value="Realizar Prestamo">
            </form>
            @else
                <strong>Se ha detetectado que no te has logueado -> Por favor inicia sesion</strong>
            @endif
            </div>
        </div>
    </div>
</div>

<script>
    var noCuotas;
    var quantity;
    var pago;
    $('#payments').change(function(){
        noCuotas = $(this).val();
        cantidad = $('#quantity').val();
        pago = cantidad / noCuotas;
        $('#cuota').val(pago);
    });
    $("#firstDate").change(function(){
        var date = $("#firstDate").val();
        var realDate = moment(date, 'YYYY-MM-DD').businessAdd(noCuotas)._d
        $("#lastDate").val(moment(realDate).format("YYYY-MM-DD"));
    });
</script>
@endsection