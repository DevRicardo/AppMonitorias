<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ LAConfigs::getByKey('site_description') }}">
    <meta name="author" content="Dwij IT Solutions">

    <meta property="og:title" content="{{ LAConfigs::getByKey('sitename') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ LAConfigs::getByKey('site_description') }}" />
    
    <meta property="og:url" content="http://laraadmin.com/" />
    <meta property="og:sitename" content="laraAdmin" />
	<meta property="og:image" content="http://demo.adminlte.acacha.org/img/LaraAdmin-600x600.jpg" />
    
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@laraadmin" />
    <meta name="twitter:creator" content="@laraadmin" />
    
    <title>{{ LAConfigs::getByKey('sitename') }}</title>
    
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/la-assets/css/bootstrap.css') }}" rel="stylesheet">

	<link href="{{ asset('la-assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Custom styles for this template -->
    <link href="{{ asset('/la-assets/css/main.css?'.date("Y-m-d-h-i-s")) }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <script src="{{ asset('/la-assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/la-assets/js/smoothscroll.js') }}"></script>


</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation">

<!-- Fixed navbar -->
<div id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container" style="padding-left: 0px; padding-right: 0px;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="margin-right: 20px; padding-top:  5px;" href="#">
                <img class="img-responsive" src="{{ asset('/la-assets/img/upb_logo.png') }}" width="100" alt="">
            <!--<b>
            {{ LAConfigs::getByKey('sitename') }}
            </b>-->
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#home" class="smoothScroll">Inicio</a></li>
                <li><a href="#about" class="smoothScroll">Acerca de</a></li>
                <li><a href="#contact" class="smoothScroll">Contacto</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Ingresar</a></li>
                    <!--<li><a href="{{ url('/register') }}">Register</a></li>-->
                @else
                    <li><a href="{{ url(config('laraadmin.adminRoute')) }}">{{ Auth::user()->name }}</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>


<section id="home" name="home"></section>
<div id="headerwrap">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-12">
                <!--<h1>{{ LAConfigs::getByKey('sitename_part1') }} <b><a>{{ LAConfigs::getByKey('sitename_part2') }}</a></b></h1>-->
                <h3>{{ LAConfigs::getByKey('site_description') }}</h3>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {!! session('flash_notification.message') !!}
                    </div>
                @endif
                
                <h3>
                <a href="#" class="btn btn-lg btn-success" data-toggle="modal" data-target="#AddModal">Registrate como monitor!</a>

                <a href="#" class="btn btn-lg btn-success" data-toggle="modal" data-target="#AddModalEstudiante">Registrate para tomar monitorias!</a>
               
                </h3>
                <br>
            </div>
            <!--<div class="col-lg-2">
                <h5>Amazing Functionalities</h5>
                <p>for Modern Admin Panels</p>
                <img class="hidden-xs hidden-sm hidden-md" src="{{ asset('/la-assets/img/arrow1.png') }}">
            </div>-->
            <div class="col-lg-12">
                <img class="img-responsive" src="{{ asset('/la-assets/img/fondo1.jpg') }}" alt="">
            </div>
            <!--<div class="col-lg-2">
                <br>
                <img class="hidden-xs hidden-sm hidden-md" src="{{ asset('/la-assets/img/arrow2.png') }}">
                <h5>Completely Packaged...</h5>
                <p>for Future expantion of Modules</p>
            </div>-->
        </div>
    </div> <!--/ .container -->
</div><!--/ #headerwrap -->


<section id="about" name="about"></section>
<!-- INTRO WRAP -->
<div id="intro">
    <div class="container">
        <div class="row centered">
            <h1>Monitorias academicas</h1>
            <br>
            <br>
            <div class="col-lg-4">
                <i class="fa fa-info" style="font-size:100px;height:110px;"></i>
                <h3>Informate de las monitorias</h3>
                
            </div>
            <div class="col-lg-4">
                <i class="fa fa-paper-plane" style="font-size:100px;height:110px;"></i>
                <h3>Inscripción para monitores</h3>
                
            </div>
            <div class="col-lg-4">
                <i class="fa fa-university" style="font-size:100px;height:110px;"></i>
                <h3>Inscripción para estudiantes</h3>
                
            </div>
        </div>
        <br>
        <hr>
    </div> <!--/ .container -->
</div><!--/ #introwrap -->


<!-- FORMULARIO PARA EL REGISTRO DE MONITRES   -->
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registro para dictar monitorias</h4>
            </div>
            {!! Form::open(['action' => 'LA\MonitoresController@store', 'id' => 'monitore-add-form']) !!}
            <div class="modal-body">
                <div class="box-body">
                    {{--@la_form($module)--}}
                    
                    
                    @la_input($module_monitor, 'tipo_doc')
                    @la_input($module_monitor, 'numero_doc')
                    @la_input($module_monitor, 'nombre_monitor')
                    @la_input($module_monitor, 'email_monitor')
                    @la_input($module_monitor, 'apellido_monitor')
                    @la_input($module_monitor, 'facultad_id')
                    @la_input($module_monitor, 'programa_id')
                    @la_input($module_monitor, 'promedio_credito')
                    
                    <input type="hidden" name="vista" id="vista" value="home">    



                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                {!! Form::submit( 'Registrar', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<!-- FORMULARIO PARA EL REGISTRO DE ESTUDIANTES  -->

<div class="modal fade" id="AddModalEstudiante" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Añadir Estudiante</h4>
            </div>
            {!! Form::open(['action' => 'LA\EstudiantesController@store', 'id' => 'estudiante-add-form']) !!}
            <div class="modal-body">
                <div class="box-body">
                     {{--@la_form($module)--}}
                    
                   
                    @la_input($module_estudiante, 'tipo_doc')
                    @la_input($module_estudiante, 'numero_doc')
                    @la_input($module_estudiante, 'nombres_estudiante')
                    @la_input($module_estudiante, 'apellidos_estudiante')
                    @la_input($module_estudiante, 'email_estudiante')
                    @la_input($module_estudiante, 'facultad_id')
                    @la_input($module_estudiante, 'programa_id')
                   <div class="form-group" style="display: none;">
                    <input type="hidden" value="false" name="estado_hidden">
                    <input class="form-control" checked="checked" name="estado" type="checkbox" value="estado">                                
                    </div>
                   
                    
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                {!! Form::submit( 'Registrar', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>







<!-- FEATURES WRAP -->
<div id="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 centered">
                <img class="img-responsive" src="{{ asset('/la-assets/img/monitorias.jpg') }}" alt="">
            </div>

            <div class="col-lg-7">
				<h3 class="feature-title">Requisitos para monitores</h3><br>
                <p>Para ser  monitor docente un estudiante debe cumplir con los siguientes requisitos:</p>
                <br>
				<ol class="features">
					<li>Tener un promedio crédito igual o superior a 3.50 en el período  inmediatamente anterior. </li>
					<li>No haber recibido sanciones disciplinarias.</li>
					<li>Haber aprobado el curso objeto de Monitoría con una nota no inferior a 4.0</li>
                    <li>Que en el horario en que ejerza la Monitoría no tenga obligaciones académicas en otros cursos.</li>
				</ol><br>
                <p>
                    Para participar en la elección de Monitoría Docente, el estudiante debe presentar un escrito dirigido al Director de la Facultad, en el cual se debe identificar como estudiante de la Universidad y manifestar el curso al cual pretende ser monitor.  Se debe anexar fotocopia de la cédula de ciudadanía, fotocopia del carné de la Universidad e Historia Académica.
                </p>

				<br>
               
            </div>
        </div>
    </div><!--/ .container -->
</div><!--/ #features -->

<section id="contact" name="contact"></section>
<div id="footerwrap">
    <div class="container">
        <div class="col-lg-5">
            <h3>Contacto</h3><br>
            <p>
				Universidad Pontificia Bolivariana,<br/>
				#68- a, Cq. 1 #68305, Medellín, Antioquia<br/>
                4) 4488388<br/>
                
            </p>
			<div class="contact-link" ><i class="fa fa-envelope-o"></i> <a style="color: #ffffff;" href="info@upb.edu.co">info@upb.edu.co</a></div>
			<div class="contact-link"><i class="fa fa-building"></i> <a style="color: #ffffff;" href="https://www.upb.edu.co/es/home?seccional=monteria">www.upb.edu.co</a></div>
        </div>

        <div class="col-lg-7">
            <h3>Deja tu mensaje</h3>
            <br>
            <form role="form" action="#" method="post" enctype="plain">
                <div class="form-group">
                    <label for="name1">Nombre</label>
                    <input type="name" name="Name" class="form-control" id="name1" placeholder="Your Name">
                </div>
                <div class="form-group">
                    <label for="email1">Email</label>
                    <input type="email" name="Mail" class="form-control" id="email1" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label>Mensaje</label>
                    <textarea class="form-control" name="Message" rows="3"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-large btn-success">Enviar</button>
            </form>
        </div>
    </div>
</div>
<div id="c">
    <div class="container">
        <p>
            <strong>Copyright &copy; 2017. Powered by <a style="color: #ffffff;" href="https://dwijitsolutions.com"><b>Universidad Pontificia Bolivariana</b></a>
        </p>
    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('/la-assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>
