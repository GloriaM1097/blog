<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bolsa de Trabajo/ Empresa</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style 2.4.18 -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.css')}}">
    
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Tecnm</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Bienvenido</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-users"></i>
                  {{-- <span class="hidden-xs"><i class="fa fa-users"></i></span> --}}
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="/img/tecnm1.png">
                    <p>
                      Tecnológico Nacional de México campus Tuxtla Gutiérrez
                      <small>www.tuxtla.tecnm.mx</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Cerrar</a>
                      <a href="{{url('/exitempresa')}}" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            @if(Auth::user()->tipo == 1)
            <li class="treeview">
              <a href="{{route('empresa.nuevo')}}">
                <i class="fa fa-user"></i>
                <span>Registrarse</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>			
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Perfil</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Nueva Solicitud</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>      
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Solicitudes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              
            </li>
           
             @else
             @if(Auth::user()->tipo == 0 )
            		
            
            <li class="treeview">
              <a href="{{route('empresa.show',Crypt::encrypt($empresas->idempresa))}}">
                <i class="fa fa-th"></i>
                <span>Perfil</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              
            </li>
            <li class="treeview">
              <a href="{{route('solicitud.create')}}">
                <i class="fa fa-shopping-cart"></i>
                <span>Nueva Solicitud</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>      
            <li class="treeview">
              <a href="{{route('solicitud.index')}}">
                <i class="fa fa-folder"></i> <span>Solicitudes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              
            </li>
            
    
                @endif    
                  @endif  

                  <?php
                    $id = Auth::user()->id;
                    $p = Auth::user()->curriculo;
                   $avisoreg = DB::table('empresas')->where('users_id',$id)->exists();
                  ?>
                  <li class="treeview">
                    <a href="#"><i class="fa fa-cog"></i><span>Ajustes de la cuenta</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    <ul class="treeview-menu">
                      <li><a href="{{route('ajustesemp.show',Crypt::encrypt($id))}}"><i class="fa fa-user"></i>Cambiar Usuario/Contraseña</a></li>                                                    
                      <li><a href="{{route('ajustesemp.correo',Crypt::encrypt($id))}}"><i class="fa fa-envelope"></i>Cambiar Correo</a></li>                               
                    </ul>              
                  </a>
                  </li>

                  <li class="treeview">
                    <a href="{{url('/exitempresa')}}">
                      <i class="fa fa-close"></i> <span>Salir</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    
                  </li> 

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->        
        <section class="content">
          @if ($p == 2 )
            <div class="row">
              <div class="col-md-8"></div>
              <div class="col-md-4">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Aviso</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php 
                    $emp=Auth::user()->id;
                    $editemp = DB::table('empresas')->select('idempresa')->where('users_id',$emp)->get();  
                                     
                  ?>
                  No olvides completar tu perfil!
                  <a href="{{route('empresa.edit',Crypt::encryptString($editemp[0]->idempresa))}}">Click aqui.</a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div>
          @endif
          @if ($avisoreg == false )
          <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Aviso</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
              <div class="box-body">               
                No olvides registrar tu datos!
                <a href="{{route('empresa.nuevo')}}">Click aqui.</a>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
        @endif
          

            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Empresa</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><!--<i class="fa fa-times"></i>--></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                              <!--Contenido-->                              
                             @yield('contenido')
                              <!--Fin Contenido-->
                           </div>
                        </div>
                        
                      </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      
  
      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>


	  <script src="{{asset('js/dropdown.js')}}"></script>
    
  </body>
</html>
