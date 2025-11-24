<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lavados de Autos')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar simple -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Lavados de Autos</a>

            <div>
                <a class="btn btn-outline-light me-2" href="{{ url('/autos') }}">Autos</a>
                <a class="btn btn-outline-light" href="{{ url('/lavados') }}">Lavados</a>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer simple -->
    <footer class="text-center mt-4 mb-3 text-muted">
        &copy; 2025 Lavados de Autos
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
