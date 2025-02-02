<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terjadi Kesalahan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 50px;
            color: red;
        }

        p {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <h1>Oops! Terjadi Kesalahan</h1>
    <p>Maaf, ada kesalahan dalam sistem. Silakan coba lagi nanti.</p>
    <p><a href="{{ url('/') }}">Kembali ke Beranda</a></p>
</body>

</html>