<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script type="text/javascript">

     document.getElementById("regresar").style.display = "none";
     function imprimir(){
         document.getElementById("regresar").style.display = "none";
         //document.getElementById("imprimir").style.display = "none";
         window.print();
         document.getElementById("regresar").style.display="inline";
     }

    
</script>
<head>
	<div class="col-sm-12" style="content: center;">
	<center>
	<img HSPACE="10" VSPACE="10" src="img/educacion.png" width="350" height="100" align="left">
	<img HSPACE="10" VSPACE="10" src="img/tecnm.png" width="250" height="100" align="rigth">
	</center>
	</div>
</head>
<br><br>
<body>
    <div class="col-md-12">
      <h4>Lista De Alumnos Contratados</h4>
      <br>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Nombre De La Empresa</th>                
                <th scope="col">Correo del Contacto</th>
                <th scope="col">Nombre del Contacto</th>
                <th scope="col">Puesto Ocupado</th>
                <th scope="col">Nombre del Alumno Contratado</th> 
                <th scope="col">Fecha</th>               
        
              </tr>
            </thead>
            <tbody>
                @foreach ($empresa as $item)
                @if (in_array($item->idempresa, $array))
                <?php 
                       $nombrea = DB::table('empresas')->where('idempresa', $item->idempresa)->first();  
                       $soli = DB::table('solicitud')->where('idsolicitud', $item->idsolicitud)->first();                  
                ?>
                <tr>
                    <th>{{$nombrea->nombre}}</th>                    
                    <th>{{$nombrea->email}}</th>
                    <th>{{$nombrea->names}} {{$nombrea->apellido_paterno}} {{$nombrea->apellido_materno}}</th>                                                                    
                    <th>{{$soli->nombredelpuesto}}</th>
                    <th>{{$item->respuesta}}</th>
                    <th>{{date_format($item->created_at, 'd-m-Y')}}</th>
                </tr>
                @else
                    
                @endif
                    
           
                @endforeach
            </tbody>
          </table>
    </div>
    
<br><br>
<button onclick=" style.display='none'; imprimir();">Imprimir Tabla</button>
  {{-- <a class="btn btn-primary" id="regresar" href="{{ url('/reporte')}}" >Regresar Página Anterior</a> --}}
  <button id="regresar" onclick="window.history.back();" >Regresar Pagina Anterior</button>
</body>
<br><br>
<footer class="footer">
	<hr>
	<img src="img/logo.png" width="40" align="left">
	<img src="img/gestion.jpeg"  width="40" align="right">
	<img src="img/compact.jpg" width="40" align="right">
	<span><p align="center">Carretera Panamericana Km. 1080, C. P. 29050, Apartado Postal 599<br>Tuxtla Gutiérrez, Chiapas: Tels. (961) 61 50380, 61 50461; Ext. 101<br>www.ittg.edu.mx</p></span>
</footer>

<script src="{{asset('js/app.min.js')}}"></script>