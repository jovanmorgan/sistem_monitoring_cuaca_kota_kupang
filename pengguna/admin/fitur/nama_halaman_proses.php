<?php
// Dapatkan nama halaman dari URL saat ini tanpa ekstensi .php
$current_page_proses = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ".php");

// Tentukan judul halaman berdasarkan nama file
switch ($current_page_proses) {
    case 'dashboard':
        $page_title_proses = 'dashboard';
        break;
    case 'riwayat_data':
        $page_title_proses = 'riwayat_data';
        break;
    default:
        $page_title_proses = 'Sistem IOT - Pengguna';
        break;
}
