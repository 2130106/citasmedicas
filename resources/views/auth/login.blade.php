<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            display: flex;
            flex-direction: row;
            width: 800px;
            height: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            flex: 1;
            padding: 40px;
        }
        .image {
            flex: 1;
            background: url('/img/logoconsultorio.jpeg') no-repeat center center;
            background-size: cover;
        }
        .bg-lila {
            background-color: #9370DB;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <div class="card-header bg-lila text-white">Login</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar</button>
                </form>
                <a href="{{ route('register') }}" class="btn btn-link">Registrarse</a>
            </div>
        </div>
        <div class="image"></div>
    </div>
</body>
</html>
