<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="js/bootstrap.min.js">
        <title>Mi sitio</title>
        @vite(['resources/js/app.js', 'resources/css/app.scss'])

    </head>
    <body>
        <header>
            <?php function activeMenu($url){
                return request()->is($url) ? 'active' : '';
            } ?>
            
            
            
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="{{ activeMenu('/') }}"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                <li class="{{ activeMenu('saludos*') }}"><a class="nav-link" href="{{ route('saludos', 'Sergio') }}">Saludo</a></li>
                <li class="{{ activeMenu('mensajes/create') }}"><a class="nav-link" href="{{ route('mensajes.create') }}">Contactos</a></li>
                
                @if (auth()->check())
                    <li class="{{ activeMenu('mensajes') }}"><a class="nav-link" href="{{ route('mensajes.index') }}">Mensajes</a></li>
                    
                    @if (auth()->user()->hasRoles(['admin']))
                        <li class="{{ activeMenu('mensajes') }}"><a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                    @endif
                    
                @endif
             


            </ul>

            <ul class="navbar-nav">
                @if (auth()->guest())
                    <li><a class="nav-link {{ activeMenu('login') }}" href="/login">Login</a></li>
                @else
                    

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/usuarios/{{ auth()->id() }}/edit">Mi cuenta</a></li>
                            <li><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                        </ul>
                    </li>
                @endif

             
            </ul>
        </div>
    </div>
</nav>
            
            

        </header>
    
    <br><div class="container">
        @yield('contenido')
        <footer>Copyright {{ date('Y') }}</footer>
    </div>
    </body>
</html>