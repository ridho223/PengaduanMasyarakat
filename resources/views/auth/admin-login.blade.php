<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <style>
        /* Background hijau dengan partikel */
        body {
            background: linear-gradient(135deg, #000000, #555555, #ffffff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        /* Container untuk partikel */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        /* Animasi fade-in */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Card login */
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 900px;
            height: 450px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
            position: relative;
            z-index: 1;
        }

        /* Judul */
        .login-card h1 {
            font-size: 35px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        /* Input group */
        .input-group {
            position: relative;
        }

        .input-group-text {
            background: transparent;
            border: none;
            font-size: 18px;
            color: #888;
        }

        .form-control {
            height: 45px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #181717;
            padding: 10px;
            padding-left: 40px;
            transition: border 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #98a399;
            box-shadow: 0px 0px 5px rgba(76, 175, 80, 0.5);
        }

        .input-group:focus-within .input-group-text {
            color: #98a399;
        }

        /* Tombol login */
        .btn-custom {
            background: linear-gradient(135deg, #000000, #555555, #ffffff);
            color: white;
            border: none;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
            width: 100%;
            transition: 0.3s;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-custom i {
            margin-left: 10px;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #ffffff, #000000, #555555);
            transform: scale(1.05);
            color: white;
        }

        .btn-custom:hover i {
            transform: translateX(5px);
        }
    </style>
</head>

<body>

    <!-- Efek Partikel -->
    <div id="particles-js"></div>

    <div class="login-card">
        <h1>Selamat Datang!</h1>
        <p class="mb-4 text-muted">Masuk untuk mengakses akun Anda</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3 input-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <button type="button" class="btn btn-secondary">
                    <i class="fas fa-envelope"></i>
                </button>
            </div>
            <div class="mb-3 input-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                    required>
                <button type="button" class="btn btn-secondary" id="togglePassword"
                    onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye" id="eyeIcon"></i>
                </button>
            </div>
            <div class="mb-3 input-group">

                @error('email')
                    <div class="text-danger mt-3">{{ $message }}</div>
                @enderror
            </div>



            <button type="submit" class="btn btn-custom">
                Login <i class="bi bi-arrow-right"></i>
            </button>
        </form>
    </div>

    <script>
        // Konfigurasi partikel
        particlesJS("particles-js", {
            particles: {
                number: { value: 50, density: { enable: true, value_area: 800 } },
                color: { value: "#ffffff" },
                shape: { type: "circle" },
                opacity: { value: 0.5, random: false },
                size: { value: 3, random: true },
                move: { enable: true, speed: 2, direction: "none", random: false }
            },
            interactivity: {
                events: {
                    onhover: { enable: true, mode: "repulse" }
                }
            },
            retina_detect: true
        });

        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var eyeIcon = document.getElementById('eyeIcon');

            // Toggle antara password dan text
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>