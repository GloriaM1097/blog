@extends('layouts.admin')
@section('colores')
    
    <link rel="stylesheet" type="text/css" href="https://www.jquery-az.com/javascript/alert/dist/sweetalert.css">
	<script src="https://www.jquery-az.com/javascript/alert/dist/sweetalert-dev.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
@stop
@section('seccion')
<script type="text/javascript">
    $(document).ready(function () {
    $('input#numerocontrol')
        .keypress(function (event) {
        if (this.value.length === 8) {
            return false;
        }
        });
    });

    $(document).ready(function () {
    $('input#nombres')
        .keypress(function (event) {
        if (this.value.length === 100) {
            return false;
        }
        });
    });

    $(document).ready(function () {
    $('input#apellido')
        .keypress(function (event) {
        if (this.value.length === 60){
            return false;
        }
        });
    });

</script>
<br>
@include('sesionstatus')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edición De Usuario Egresado</div>
                <div class="card-body">
                    <form  action="{{ Route('RegistroEgresado.update', $editregistro->id) }}" method="POST">
                    @method('PUT')                
                    @csrf   
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-md-right">Número de Control: </label>
                        <div class="col-md-6">
                           <input type="number" name="numerocontrol" id="numerocontrol" required class="form-control" value="{{ $editregistro->numero_control}}" placeholder="Número de Control"> 
                        </div>                            
                    </div>  
                    
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-md-right">Nombre(s): </label>
                        <div class="col-md-6">
                           <input type="text" id="nombres" name="nombre" required class="form-control" placeholder="Nombre(s)" value="{{ $editregistro->nombres}}"> 
                        </div>                            
                    </div> 

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-md-right">Apellido Paterno: </label>
                        <div class="col-md-6">
                           <input type="text" id="apellido" name="apellidop" required class="form-control" placeholder="Apellido Paterno" value="{{ $editregistro->apellido_paterno}}"> 
                        </div>                            
                    </div> 

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-md-right">Apellido Materno: </label>
                        <div class="col-md-6">
                           <input type="text" id="apellido" name="apellidom" required class="form-control" placeholder="Apellido Materno" value="{{ $editregistro->apellido_materno}}"> 
                        </div>                            
                    </div> 

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-md-right">Correo Electrónico: </label>
                        <div class="col-md-6">
                           <input type="email" name="correo" required class="form-control" placeholder="Correo Electronico" value="{{ $editregistro->email}}"> 
                        </div>                            
                    </div> 
                           
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </div>                                                                      
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
