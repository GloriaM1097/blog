@extends('administradora.inicio3')
@section('contenido')
@if ($existe == 'Si')
<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-4">
    <div class="box box-default">
      <div class="box-header with-border">
        <h5 class="box-title">Aviso:</h5>
      </div><!-- /.box-header -->
      <div class="box-body">
    
       El correo ya se encuentra en uso!!
       
      </div><!-- /.box-body -->
    </div><!-- /.box -->
    </div>
    
@endif
<div class="container">      
        <div class="col-sm-10" >

          <div class="panel panel-success"><br>
              <h2 class="panel-title"><center><font size="5"></i>Edición Correo Administrador</font></center></h2>

            <div class="panel-body">              
                <div class=" col-md-12"> 
                    <div class="card">
                                
                        <div class="card-body">
                            <form action="{{ route('ajustescorreoadministrador.update', $usuario->id) }}" method="post">
                                @csrf
                                @method('PUT')
        
                                <div class="form-group">                                    
                                    <div class="col-md-6">
                                        <label>Correo Electrónico:</label>
                                       <input type="email" name="email" required class="form-control" value="{{ $usuario->email }}"> 
                                    </div>                            
                                </div>                               
                        
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <br>
                                        <input type="submit" value="Guardar Cambios" class="btn btn-success">  
                                    </div>                            
                                </div>
        
                            </form>
                        </div>
                    </div>
                     </div>
                </div>
            </div>
          </div>
        </div>
</div>
                             
@endsection