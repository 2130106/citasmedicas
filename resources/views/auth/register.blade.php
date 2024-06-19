<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
            <div class="card-header bg-lila text-white">Register</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <a href="{{ route('login') }}" class="btn btn-link">Login</a>
            </div>
        </div>
        <div class="image"></div>
    </div>
</body>
</html>
