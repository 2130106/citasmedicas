<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <div class="sidebar">
        <!-- Contenido del sidebar -->
    </div>

    <div class="content">
        <div class="header">
            <!-- Contenido del header -->
        </div>
        
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Scripts al final para mejorar el rendimiento de carga -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#fecha', {
            dateFormat: 'Y-m-d',
            enableTime: false,
            minDate: 'today'
        });
    </script>
</body>
</html>
