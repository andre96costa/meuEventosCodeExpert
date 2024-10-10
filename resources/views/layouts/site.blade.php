<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Eventos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                            <a class="dropdown-item" href="{{ route('home', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <form class="d-flex" method="GET">
                <input class="form-control me-2" type="search" placeholder="Buscar evento" aria-label="Search" name="s" value="{{ request()->query('s') }}">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('admin.events.index') }}" class="nav-link">Meu painel</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                @endauth
            </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('messages.bootstrap.messages')
            </div>
        </div>
        @yield('content') <!-- Todas as views que estenderem desta, colocarão seu conteúdo nesta área. -->
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>