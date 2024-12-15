<?php
// Dapatkan nama halaman dari URL saat ini tanpa ekstensi .php
$current_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ".php");

// Tentukan judul halaman berdasarkan nama file
switch ($current_page) {
    case 'dashboard':
        $page_title = 'Dashboard';
        break;
    case 'cuti':
        $page_title = 'Cuti';
        break;
    case 'pegawai':
        $page_title = 'Pegawai';
        break;
    case 'kepsek':
        $page_title = 'Kepala Sekolah';
        break;
    case 'mutasi':
        $page_title = 'Mutasi';
        break;
    case 'gaji':
        $page_title = 'Gaji';
        break;
    case 'jabatan':
        $page_title = 'Jabatan';
        break;
    case 'pensiun':
        $page_title = 'Pensiun';
        break;
    case 'galeri':
        $page_title = 'Galeri';
        break;
    case 'lokasi':
        $page_title = 'Lokasi Kerja';
        break;
    case 'riwayat_data':
        $page_title = 'Riwayat Data BME280';
        break;
    case 'profile':
        $page_title = 'Profile Saya';
        break;
    case 'log_out':
        $page_title = 'Log Out';
        break;
    default:
        $page_title = 'Admin SMK 4 Atambua';
        break;
}
