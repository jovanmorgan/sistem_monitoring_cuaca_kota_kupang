<?php
// Ambil data dari file yang diupdate oleh ESP8266 (data.json)
$jsonData = file_get_contents('data.json');

// Set tipe konten menjadi JSON
header('Content-Type: application/json');

// Kirim data JSON ke browser
echo $jsonData;
