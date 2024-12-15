<?php
header('Content-Type: application/json');

// Ambil data POST
$suhu = $_POST['suhu'] ?? null;
$tekanan = $_POST['tekanan'] ?? null;
$ketinggian = $_POST['ketinggian'] ?? null;
$kelembaban = $_POST['kelembaban'] ?? null;

// Buat array data
$data = array(
    'suhu' => $suhu,
    'tekanan' => $tekanan,
    'ketinggian' => $ketinggian,
    'kelembaban' => $kelembaban
);

// Nama file JSON
$filename = "data.json";

// Tulis data ke file JSON jika data valid
if (is_numeric($suhu) && $suhu != 0 && is_numeric($kelembaban) && $kelembaban != 0) {
    $file = fopen($filename, "w");
    fwrite($file, json_encode($data));
    fclose($file);

    // Kirimkan data ke database
    include('../../keamanan/koneksi.php');

    // Periksa koneksi
    if ($koneksi) {
        $waktu = date("Y-m-d H:i:s");

        // Insert data ke tabel
        $query = "INSERT INTO sistem (suhu, tekanan, ketinggian, kelembaban, waktu) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('dddds', $suhu, $tekanan, $ketinggian, $kelembaban, $waktu);

        if ($stmt->execute()) {
            // Mengecek id pengguna di telegram 
            // https://api.telegram.org/bot7209049678:AAFNw5BoNGWX6QIZcfDQkGZlDeIzawWav4U/getupdates
            // Kirimkan pesan ke Telegram hanya jika data valid
            $botToken = "7209049678:AAFNw5BoNGWX6QIZcfDQkGZlDeIzawWav4U";
            // $chatId = "1432145331";
            $chatId = "5178782729";
            $message = "Data dari alat:\n\nSuhu: $suhu °C\nTekanan: $tekanan hPa\nKetinggian: $ketinggian m\nKelembaban: $kelembaban %\nWaktu: $waktu";

            $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $telegramUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            // Debugging: Tampilkan respon dari Telegram API
            error_log("Telegram API Response: $response");

            echo json_encode(array('status' => 'success', 'message' => 'Data Sudah Dikirim ke database Dan Telegram.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to insert data into database.'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Database connection failed.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid data: Data TIdak Terkirim Ketelagram.'));
}
