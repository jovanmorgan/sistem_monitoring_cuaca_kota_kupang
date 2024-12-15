<?php
include '../../../../keamanan/koneksi.php';

// Terima data dari form tambah
$tanggal_mutasi = $_POST['tanggal_mutasi'];
$tempat_mutasi = $_POST['tempat_mutasi'];
$sk_mutasi = $_POST['sk_mutasi'];
$id_pegawai = $_POST['id_pegawai'];

// Lakukan validasi data
if (empty($tanggal_mutasi) || empty($tempat_mutasi) || empty($sk_mutasi) || empty($id_pegawai)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menambahkan data mutasi ke dalam database
$query = "INSERT INTO mutasi (tanggal_mutasi, tempat_mutasi, sk_mutasi, id_pegawai) 
          VALUES ('$tanggal_mutasi', '$tempat_mutasi', '$sk_mutasi', '$id_pegawai')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
