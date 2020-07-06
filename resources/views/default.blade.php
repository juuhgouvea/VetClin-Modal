<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" integrity="sha256-zmfNZmXoNWBMemUOo1XUGFfc0ihGGLYdgtJS3KCr/l0=" crossorigin="anonymous">
    <title>VetClin System</title>
</head>
<body>
    <header>
        <nav class="container navbar navbar-expand-lg navbar-dark bg-success mb-5 p-3">
            <a class="navbar-brand font-weight-bold" href="/">VetClin System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav font-weight-bold">
                <a class="nav-item nav-link active"  href="{{route('clientes.index')}}">Clientes</a>
                <a class="nav-item nav-link"  href="{{route('veterinarios.index')}}">Veterinários</a>
                <a class="nav-item nav-link"  href="{{route('especialidades.index')}}">Especialidades</a>
                <a class="nav-item nav-link"  href="{{route('clientes.index')}}">Pets</a>
                <a class="nav-item nav-link"  href="{{route('clientes.index')}}">Raças</a>
                </div>
            </div>
        </nav>
    </header>
    <div class="card ">
        <div class="container bg-success mb-5 p-3 ">
        <h3><b class="font-weight-bold text-white">{{$titulo}}</b></h3>
        </div>
        <div class="container">
            @yield('content')
        </div>
    </div>
    <hr class="container my-4">
    <footer class="container">
        <h5 class="ml-5 text-dark text-small">&copy;2020 <i class="fas fa-angle-double-right"></i> Julia Gouvêa</h5>
    </footer>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
</html>