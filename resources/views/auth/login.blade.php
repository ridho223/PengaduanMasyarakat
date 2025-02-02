<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            /* Light background */
        }

        .container-auth {
            width: 100vw;
            height: 100vh;
            display: flex;
        }

        /* Panel */
        .panel {
            width: 65%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            transition: 0.5s;
            background: radial-gradient(circle, #555555, #ffffff);

            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        /* Info Panel */
        .info-panel {
            width: 35%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            transition: 0.5s;
            background: linear-gradient(135deg, #000000, #555555, #ffffff);
            /* Elegant dark green gradient */
            color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        /* Button Custom Styling */
        .btn-custom {
            background: linear-gradient(135deg, #000000, #555555, #ffffff);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 20px;
            border-radius: 30px;
            width: 85%;
            transition: 0.3s;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #ffffff, #000000, #555555);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: white;
        }

        /* Form Input Styling */
        .input-group {
            height: 60px;
            width: 500px;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .input-group:focus {
            border-color: #424442;
            box-shadow: 0 4px 12px rgba(57, 58, 57, 0.3);
        }

        input.form-control {
            height: 60px;
            width: 500px;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        input.form-control:focus {
            border-color: #424442;
            box-shadow: 0 4px 12px rgba(57, 58, 57, 0.3);
        }

        .d-flex {
            display: flex;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 60%;
            z-index: 0;
            pointer-events: none;
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
    </style>
</head>

<body>

    <div class="container-auth d-flex">
        <div id="particles-js"></div>
        <!-- Panel Info -->
        <div class="info-panel order-1" id="infoPanel">
            <h1 id="titleText">Selamat Datang!</h1>
            <p id="subtitleText">Sudah punya akun? Silakan masuk.</p>
            <button class="btn btn-light btn-lg" onclick="toggleForm()">Login</button>
        </div>

        <!-- Panel Form -->
        <div class="panel order-2" id="formPanel">
            <!-- Form Login -->
            <form action="{{ route('login') }}" id="loginForm" method="POST">
                @csrf
                <h2 class="mb-5 text-center">Login</h2>

                {{-- email --}}
                <label class="form-label">Email</label>
                <div class="mb-3 input-group">
                    <input type="email" name="email" class="form-control" required placeholder="Email@gmail.com">
                    <button type="button" class="btn btn-secondary">
                        <i class="fas fa-envelope"></i>
                    </button>
                </div>

                {{-- password --}}
                <label class="form-label">Password</label>
                <div class="mb-3 input-group">
                    <input type="password" name="password" class="form-control" id="password" required
                        placeholder="12345678">
                    <button type="button" class="btn btn-secondary" id="togglePassword"
                        onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>

                @error('email')
                    <div class="text-white mt-3">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-custom w-100 mt-3">Login</button>
                <p class="mt-3 text-center">Belum punya akun? <a href="#" class="text-white"
                        onclick="toggleForm()">Daftar</a></p>
            </form>

            <!-- Form Register (Disembunyikan) -->
            <form id="registerForm" action="{{ route('register-akun') }}" method="POST" style="display: none;">
                @csrf
                <h2 class="mb-4 text-center">Register</h2>
                <label>Nama</label>
                <div class="mb-3 input-group">
                    <input type="text" name="name" class="form-control" required placeholder="Nama">
                    <button type="button" class="btn btn-secondary">
                        <i class="fas fa-user"></i>
                    </button>
                </div>
                {{-- email --}}
                <label class="form-label">Email</label>
                <div class="mb-3 input-group">
                    <input type="email" name="email" class="form-control" required placeholder="Email@gmail.com">
                    <button type="button" class="btn btn-secondary">
                        <i class="fas fa-envelope"></i>
                    </button>
                </div>
                {{-- password --}}
                <label class="form-label">Password</label>
                <div class="mb-3 input-group">
                    <input type="password" name="password" class="form-control" id="registerPassword" required
                        placeholder="12345678">
                    <button type="button" class="btn btn-secondary" onclick="toggleBothPasswords()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                {{-- konfirmasi password --}}
                <label>Konfirmasi password</label>
                <div class="mb-3 input-group">
                    <input type="password" name="password_confirmation" class="form-control" required
                        id="confirmPassword" placeholder="12345678">
                    <button type="button" class="btn btn-secondary" onclick="toggleBothPasswords()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                <button type="submit" class="btn btn-custom w-100 mt-3">Daftar</button>
                <p class="mt-3 text-center">Sudah punya akun? <a href="#" class="text-white "
                        onclick="toggleForm()">Login</a></p>
            </form>
        </div>
    </div>

    <script>
        function toggleForm() {
            let loginForm = document.getElementById("loginForm");
            let registerForm = document.getElementById("registerForm");
            let titleText = document.getElementById("titleText");
            let subtitleText = document.getElementById("subtitleText");
            let infoPanel = document.getElementById("infoPanel");
            let formPanel = document.getElementById("formPanel");

            if (loginForm.style.display === "none") {
                // Switch to Login
                loginForm.style.display = "block";
                registerForm.style.display = "none";
                titleText.innerHTML = "Selamat Datang!";
                subtitleText.innerHTML = "Sudah punya akun? Silakan masuk.";

                // Swap positions without resizing
                infoPanel.classList.remove("order-2");
                infoPanel.classList.add("order-1");
                formPanel.classList.remove("order-1");
                formPanel.classList.add("order-2");

            } else {
                // Switch to Register
                loginForm.style.display = "none";
                registerForm.style.display = "block";
                titleText.innerHTML = "Ayo Bergabung!";
                subtitleText.innerHTML = "Buat akun baru sekarang.";

                // Swap positions without resizing
                infoPanel.classList.remove("order-1");
                infoPanel.classList.add("order-2");
                formPanel.classList.remove("order-2");
                formPanel.classList.add("order-1");
            }
        }
    </script>
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
        function toggleBothPasswords() {
            var passwordField = document.getElementById('registerPassword');
            var confirmPasswordField = document.getElementById('confirmPassword');
            var eyeIcons = document.querySelectorAll('#eyeIcon'); // Ambil semua icon mata

            // Toggle antara password dan text
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                confirmPasswordField.type = 'text';
                eyeIcons.forEach(icon => {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                });
            } else {
                passwordField.type = 'password';
                confirmPasswordField.type = 'password';
                eyeIcons.forEach(icon => {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                });
            }
        }
    </script>

</body>

</html>