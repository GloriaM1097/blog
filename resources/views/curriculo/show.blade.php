@extends('egresado.inicio')
@section('contenido')

<div class="container">
    <div class="row">
      <div class=" col-sm-10" >
        <div class="panel panel-success">
          <div class="panel-body">
              <div class=" table-responsive col-sm-12 "> 
                <table class="table table-condensed">
                  <thead>   
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

     <title>One Page Resume</title>

     <style type="text/css">
        * { margin: 0; padding: 0; }
        body { font: 16px Helvetica, Sans-Serif; line-height: 24px; background: url(images/noise.jpg); }
        .clear { clear: both; }
        #page-wrap { width: 800px; margin: 40px auto 60px; }
        #pic { float: right; margin: -30px 0 0 0; }
        h1 { margin: 0 0 16px 0; padding: 0 0 16px 0; font-size: 42px; font-weight: bold; letter-spacing: -2px; border-bottom: 1px solid #999; }
        h2 { font-size: 20px; margin: 0 0 6px 0; position: relative; }
        h2 span { position: absolute; bottom: 0; right: 0; font-style: italic; font-family: Georgia, Serif; font-size: 16px; color: #999; font-weight: normal; }
        p { margin: 0 0 16px 0; }
        a { color: #999; text-decoration: none; border-bottom: 1px dotted #999; }
        a:hover { border-bottom-style: solid; color: black; }
        ul { margin: 0 0 32px 17px; }
        #objective { width: 500px; float: left; }
        #objective p { font-family: Georgia, Serif; font-style: italic; color: #666; }
        dt { font-style: italic; font-weight: bold; font-size: 18px; text-align: right; padding: 0 26px 0 0; width: 150px; float: left; height: 100px; border-right: 1px solid #999;  }
        dd { width: 600px; float: right; }
        dd.clear { float: none; margin: 0; height: 15px; }
     </style>
</head>

<body>

    <div id="page-wrap">
    <br>
        <img src="{{asset('img/'.$hola->curriculo->imagen)}}" alt="Photo of Cthulu" id="pic" height="240px" width="150px"/>
    
        <div id="contact-info" class="vcard">
        
            <!-- Microformats! -->
        
            <h1 class="fn">{{$hola->curriculo->nombres}} {{$hola->curriculo->apellido_paterno}} {{$hola->curriculo->apellido_materno}}</h1>
        
            <p>
                Cell: <span class="tel">{{$hola->curriculo->numero_cel}}</span><br />
                Email: <span class="email" href="#">{{$hola->curriculo->correo}}</a><br />
                Estado: <span class="estado">{{$hola->estado->nombre_estado}}</span><br />
                Municipio: <span class="municipio">{{$hola->municipio->nombre_localidad}}</span><br />
                Domicilio: <span> {{$hola->curriculo->domicilio}}</span>. Colonia: <span>{{$hola->curriculo->colonia}}</span>
                
            </p>
        </div>
                
        <div class="clear"></div>
        
        <dl>
            <dd class="clear"></dd>
            
            <dt>Educación</dt>
            <dd>
                <h2>{{$hola->escuela}}</h2>
                <p><strong>Carrera:</strong> {{$hola->perfil->carrera}}<br />
                   <strong>Especialidad:</strong> {{$hola->especialidad}} <br>
                   <strong>Duración:</strong> {{$hola->duracion}} <br>
                   <strong>Periodo:</strong> Inicio: {{$hola->fecha_inicio}} - Termino: {{$hola->fecha_termino}}</p>
            </dd>
            
            <dd class="clear"></dd>

            <dt>Experiencia</dt>
            <dd>                
                <?php
                    if ($hola->experiencia == " ") {
                        echo '<p>Sin experiencia</p>';
                    }else {
                        $res = json_decode($hola->experiencia,true);
                        foreach ($res as $value) {
                        $cadena = $value['Puesto'];
                        echo '<p>Puesto: '.($cadena).'<br>';
                        $cadena = $value['Empresa'];
                        echo 'Empresa: '.($cadena).'<br>';
                        $cadena = $value['Actividades'];
                        echo 'Actividades y Logros: '.($cadena).'<br>';
                        $cadena = $value['Fecha_e'];
                        echo 'Fecha de entrada: '.($cadena).'<br>';
                        $cadena = $value['Fecha_s'];
                        echo 'Fecha de salida: '.($cadena).'</p>';                     
                        }
                    }
                    
                ?>
            </dd>

            <dd class="clear"></dd>
            
            <dt>Cursos / <br>Certificaciones</dt>
            <dd>
                <?php
                if ($hola->curso == " ") {
                    echo '<p>Sin cursos</p>';
                }else {
                    $res = json_decode($hola->curso,true);
                    foreach ($res as $value) {
                    $cadena = $value['Curso'];
                    echo '<p>Curso: '.($cadena).'<br>';
                    $cadena = $value['Enlace'];
                    echo 'Enlace: '.($cadena).'<br>';
                    $cadena = $value['Descripcion'];
                    echo 'Descripcion: '.($cadena).'<br>';
                                       
                    }
                }
                
            ?>
            </dd>

            <dd class="clear"></dd>

            <dt>Habilidad</dt>
            <dd>                    
                <p>{{$hola->habilidades}}</p>
            </dd>

            <dd class="clear"></dd>

            <dt>Objetivo Profesional:</dt>
            <dd>                    
                <?php 
                    $res = json_decode($hola->objetivo,true);
                    //dd($res);                 
                    echo '<p>Puesto: '.($res[0]).'<br>';
                    echo 'Salario: $'.($res[1]).' pesos mensuales <br>';                                                                                
                    echo 'Objetivo Profesional: '.($res[2]).'</p>'; 
                ?>
            </dd>
            
            
            <dd class="clear"></dd>
            
            <dt>Idioma</dt>
            <dd>
               <h2>{{$hola->idioma->idioma}}</h2>
               <p><strong>Nivel:</strong> {{$hola->nivel->nivel}}</p>
            </dd>
            
           
            
            <dd class="clear"></dd>
        </dl>
        
        <div class="clear"></div>
    </div>

    <td>
                    <a href="{{route('curriculo.edit',$hola)}}"><button class="btn btn-primary">Editar</button></a>
                     </td>
                     <a href="{{url('curriculopdf',$hola)}}"><button class="btn btn-success">Descargar</button></a>
                    </td>
</body>

                  </thead>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection