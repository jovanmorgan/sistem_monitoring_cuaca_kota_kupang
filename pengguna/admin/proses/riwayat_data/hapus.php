<?php
include '../../../../keamanan/koneksi.php';

// Terima ID sistem yang akan dihapus dari formulir HTML
$id_sistem = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_sistem)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data sistem berdasarkan ID
$query_delete_sistem = "DELETE FROM sistem WHERE id_sistem = '$id_sistem'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_sistem)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
