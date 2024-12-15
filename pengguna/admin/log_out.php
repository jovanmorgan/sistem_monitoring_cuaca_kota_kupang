<?php
session_start();

// Hapus sesi id_admin jika ada
if (isset($_SESSION['id_admin'])) {
    unset($_SESSION['id_admin']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../berlangganan/login");
exit;
