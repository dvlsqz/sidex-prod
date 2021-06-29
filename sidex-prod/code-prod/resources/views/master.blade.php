<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ Config::get('sidex.name') }} - @yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="routeName" content="{{ Route::currentRouteName() }}">

	<!-- CSS only -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" href="{{ url('/static/css/style.css?v='.time()) }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>
	<link rel="shortcut icon" href="{{ url('/img/Isotipo.ico') }}" type="image/x-icon">

	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
 
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<!--<script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script> -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
	<script src="{{ url('/static/js/mdslider.js?v='.time()) }}"></script>
	<script src="{{ url('/static/js/site.js?v='.time()) }}"></script>
</head>
<body>

	<nav class="navbar navbar-expand-lg shadow">
		<div class="container">
			<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/static/imagenes/Isotipo.png') }}"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigationMain" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<div class="collapse navbar-collapse" id="navigationMain">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a href="{{ url('#') }}" class="nav-link"><span> Sistema de Extensiones Telefonicas IGSS</span></a>
					</li>
					@if(!Auth::guest())
						<li class="nav-item">
							<a href="{{ url('/inicio/todas') }}" class="nav-link"><i class="fas fa-home"></i> <span> Inicio</span></a>
						</li>
					@endif
					@if(Auth::guest())
					<li class="nav-item link-acc">
						<a href="{{ url('/login') }}" class="nav-link btn"><i class="fas fa-fingerprint"></i> Ingresar</a>
					</li>
					@else
					<li class="nav-item dropdown link-acc link-user">
						<a href="#" class="nav-link btn dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
							@if(is_null(Auth::user()->avatar)) 
                                <img src="{{ url('/static/imagenes/default-avatar.png') }}"> 
                            @else 
                                <img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar ) }}">  
                            @endif Bienvenido: {{ Auth::user()->name }}
						</a>
						<ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
							@if(Auth::user()->role == "0" || Auth::user()->role == "1" || Auth::user()->role == "2")
								<li>
                                    <a class="dropdown-item" href="{{ url('/admin') }}">
                                        <i class="fas fa-clipboard-list"></i> Administración
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
							<li>
                                <a class="dropdown-item" href="{{ url('/account/edit') }}">
									<i class="fas fa-fingerprint"></i> Cambiar Contraseña
                                </a>
                            </li>
							<li>
								<a class="dropdown-item" href="{{ url('/logout') }}">
									<i class="fas fa-sign-out-alt"></i> Salir
								</a>
							</li>
						</ul>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>




	@if(Session::has('messages'))
		<div class="container">           
		<div class="alert alert-{{ Session::get('typealert') }} mtop16" style="display:block; margin-bottom: 16px;"> 
			{{ Session::get('messages') }}
			@if ($errors->any())       
			<ul>
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			@endif
			<script>
				$('.alert').slideDown();
				setTimeout(function(){ $('.alert').slideUp(); }, 10000);
			</script>
		</div>
		</div>
	@endif

    <div class="wrapper">
        <div class="container">        
            @yield('content')           
        </div>
    </div>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>