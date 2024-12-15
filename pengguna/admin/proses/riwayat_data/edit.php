<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari form edit
$id_mutasi = $_POST['id_mutasi'];
$tanggal_mutasi = $_POST['tanggal_mutasi'];
$tempat_mutasi = $_POST['tempat_mutasi'];
$sk_mutasi = $_POST['sk_mutasi'];
$id_pegawai = $_POST['id_pegawai'];

// Lakukan validasi data
if (empty($id_mutasi) || empty($tanggal_mutasi) || empty($tempat_mutasi) || empty($sk_mutasi) || empty($id_pegawai)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk mengupdate data mutasi berdasarkan id_mutasi
$query = "UPDATE mutasi 
          SET tanggal_mutasi = '$tanggal_mutasi', tempat_mutasi = '$tempat_mutasi', sk_mutasi = '$sk_mutasi', id_pegawai = '$id_pegawai'
          WHERE id_mutasi = '$id_mutasi'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
