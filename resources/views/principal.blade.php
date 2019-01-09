<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin- Masea">
    <meta name="author" content="Admin- Masea">
    <meta name="keyword" content="Admin- Masea">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Admin- Masea</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="css/plantilla.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">
        <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div @click="menu=5" class="nav-item">
                <button class="btn btn-primary">Agregar Nuevo Desarrollo</button><!-- @click="abrirModal('desarrollo','registrar')" -->
            </div>
            
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link " href="#" aria-haspopup="true" aria-expanded="false">
                        <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                        <span class="d-md-down-none">{{Auth::user()->name}} </span>
                    </a>
                </li>
                <li class="nav-item">
                    |
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Salir &nbsp;<i class="fa fa-sign-out"></i> 
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </header>
    
        <div class="app-body">

            @if(Auth::check())
                @if(Auth::user()->idrol == 1)
                    @include('plantilla.sidebaradministrador')
                @elseif(Auth::user()->idrol == 2)
                    @include('plantilla.sidebarempleado')
                @else

                @endif
            @endif

            <!-- Contenido Principal -->
           @yield('contenido')
            <!-- /Fin del contenido principal -->
        </div>
    </div>

    <script src="js/plantilla.js"></script>
    <script src="js/app.js"></script>
</body>

</html>