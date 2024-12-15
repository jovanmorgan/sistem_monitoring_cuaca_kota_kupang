<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="../assets/img/sistem_iot/logo.jpg?v=<?= time(); ?>" rel="icon" />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap?v=<?= time(); ?>" rel="stylesheet">
    <title>Login</title>
    <link href="../css/login&register.css?v=<?= time(); ?>" rel="stylesheet" />
    <!-- Link untuk Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?v=<?= time(); ?>">
    <style>
    :root {
        --background: #F4F4F9;
        --color: #ffffff;
        --primary-color: #005CAF;
    }

    .show-password {
        position: absolute;
        bottom: 157px;
        right: 45px;
    }

    .login-container form input {
        color: #000;
        display: block;
        padding: 14.5px;
        width: 100%;
        margin: 2rem 0;
        outline: none;
        background-color: #ffffffd5;
        border: none;
        border-radius: 5px;
        font-weight: 500;
        letter-spacing: 0.8px;
        font-size: 15px;
        backdrop-filter: blur(15px);
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
    }
    </style>
</head>

<body>
    <section class="container">
        <div class="login-container">
            <!-- <div class="circle circle-one"></div> -->
            <div class="form-container">
                <!-- <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" /> -->
                <h1 class="opacity" style="text-align: center;">LOGIN</h1>
                <form id="login" action="../keamanan/proses_login" method="POST">
                    <input type="text" name="username" placeholder="Username" />
                    <div class="password-container">
                        <input type="password" name="password" id="login-password" placeholder="Password" required>
                        <i class="fa fa-eye-slash show-password" style="color: #000;" aria-hidden="true"
                            onclick="togglePasswordVisibility('login-password')"></i>
                    </div>
                    <button type="submit" class="opacity">SUBMIT</button>
                </form>
            </div>
            <!-- <div class="circle circle-two"></div> -->
        </div>
        <div class="theme-btn-container"></div>
    </section>

    </style>
    <!-- End footer -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        var passwordIcon = document.querySelector(
            "#" + inputId + " + .show-password"
        );

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordIcon.classList.remove("fa-eye-slash");
            passwordIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            passwordIcon.classList.remove("fa-eye");
            passwordIcon.classList.add("fa-eye-slash");
        }
    }
    document.getElementById("login").addEventListener("submit", function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../keamanan/proses_login", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    var responseArray = response.split(':');
                    if (responseArray[0].trim() === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login berhasil!',
                            text: 'Selamat datang ' + responseArray[1],
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        }).then((result) => {
                            switch (responseArray[2].trim()) {
                                case "admin":
                                    window.location.href = "../pengguna/admin/";
                                    break;
                                default:
                                    window.location.href = "login";
                                    break;
                            }
                        });

                        if (rememberMe) {
                            var username = formData.get('username');
                            var password = formData.get('password');
                            document.cookie = "username=" + encodeURIComponent(
                                username) + "; path=/";
                            document.cookie = "password=" + encodeURIComponent(password) + "; path=/";
                        }
                    } else if (responseArray[0].trim() === "error_password") {
                        Swal.fire("Error", "Password yang dimasukkan salah", "error");
                    } else if (responseArray[0].trim() === "error_username") {
                        Swal.fire("Error", "Username tidak ditemukan", "error");
                    } else if (responseArray[0].trim() === "username_tidak_ada") {
                        Swal.fire("Info", "Username belum diisi", "info");
                    } else if (responseArray[0].trim() === "password_tidak_ada") {
                        Swal.fire("Info", "Password belum diisi", "info");
                    } else if (responseArray[0].trim() === "tidak_ada_data") {
                        Swal.fire("Info", "Username dan Password belum diisi", "info");
                    } else {
                        Swal.fire("Error", "Terjadi kesalahan saat proses login", "error");
                    }
                } else {
                    Swal.fire("Error", "Gagal", "error");
                }
            }
        };
        xhr.onerror = function() {
            Swal.fire("Error", "Gagal melakukan request", "error");
        };
        xhr.send(formData);
    });
    </script>
</body>

</html>