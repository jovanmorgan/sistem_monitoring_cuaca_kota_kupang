<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link href="../css/login&register.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../images/logo.png" type="" />
    <!-- Link untuk Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .illustration {
            position: absolute;
            top: -7%;
            right: -2px;
            width: 90%;
        }
    </style>
</head>

<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <!-- <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" /> -->
                <h1 class="opacity" style="text-align: center;">REGISTER</h1>
                <form id="registrasi" action="../keamanan/proses_register_pengunjung" method="POST">
                    <input type="text" name="nama" placeholder="Nama" />
                    <input type="text" name="username" placeholder="Username" />
                    <div class="password-container">
                        <input type="password" name="password" id="login-password" placeholder="Password" required>
                        <i class="fa fa-eye-slash show-password" aria-hidden="true" onclick="togglePasswordVisibility('login-password')"></i>
                    </div>
                    <button type="submit" class="opacity">SUBMIT</button>
                </form>
                <div class="register-forget opacity">
                    <a href="login_pegunah">LOGIN</a>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
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

        document
            .getElementById("registrasi")
            .addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent the form from submitting by default

                // Get the form element
                var form = this;

                // Ambil data dari form
                var formData = new FormData(form);

                // Cek apakah semua input diisi
                var nama = formData.get("nama");
                var password = formData.get("password");
                var username = formData.get("username");

                if (
                    nama === "" ||
                    password === "" ||
                    username === ""
                ) {
                    Swal.fire("Error", "Semua data wajib diisi", "error");
                    return; // Stop the submission process if any input is empty
                }

                // Kirim data menggunakan AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../keamanan/proses_register_pengunjung", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Tampilkan SweetAlert berdasarkan respon dari ../keamanan/proses_register_pengunjung
                            var response = xhr.responseText;
                            if (response.trim() === "success") {
                                // Reset the form after successful submission
                                form.reset();
                                Swal.fire({
                                    title: "Success",
                                    text: "Data berhasil ditambahkan",
                                    icon: "success"
                                })
                            } else if (response.trim() === "error_admin_code") {
                                Swal.fire("Error", "Kode admin tidak sesuai", "error");
                            } else if (response.trim() === "error_username_exists") {
                                Swal.fire("Error", "Akun ini sudah terdaftar!, Silakan gunakan akun lain",
                                    "error");
                            } else if (response.trim() === "username_belum_pas") {
                                Swal.fire("Error", "Nomor Registrasi harus memiliki minimal 12 Nomor", "error");
                            } else if (response.trim() === "error_password_length") {
                                Swal.fire("Error", "Password harus memiliki minimal 8 karakter", "error");
                            } else if (response.trim() === "error_password_strength") {
                                Swal.fire("Error",
                                    "Password harus mengandung huruf besar, huruf kecil, dan angka", "error"
                                );
                            } else {
                                Swal.fire("Error", "Terjadi kesalahan saat proses login", "error");
                            }
                        } else {
                            Swal.fire("Error", "Gagal melakukan request", "error");
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