<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            /* background: linear-gradient(to right, #28a745, #218838); */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-body {
            padding: 2rem;
        }

        .form-control {
            height: 50px;
            font-size: 16px;
            border-radius: 10px;
        }

        .btn-primary {
            height: 50px;
            font-size: 18px;
            border-radius: 25px;
            background: #218838;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #1e7e34;
        }

        .text-gray-900 {
            font-weight: bold;
            color: #2c3e50;
        }

        .small a {
            text-decoration: none;
            font-weight: 600;
            color: #218838;
            transition: 0.3s;
        }

        .small a:hover {
            color: #1e7e34;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg border-0 w-75 p-4">
            <div class="card-body p-4">
                <h1 class="h4 text-gray-900 text-center mb-4">Lupa Password</h1>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Kirim Link Reset</button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="{{ route('auth.login') }}">Login Akun!</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>