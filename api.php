<?php
// Set header agar outputnya berupa JSON
header('Content-Type: application/json');

$dataFile = 'data.json';

// Cek metode request (GET atau POST)
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Jika file data.json tidak ada, kirim data default
    if (!file_exists($dataFile)) {
        echo json_encode(['jadwal' => [], 'tugas' => []]);
        exit;
    }

    // Baca dan kirimkan isi dari data.json
    $data = file_get_contents($dataFile);
    echo $data;

} elseif ($method === 'POST') {
    // Ambil data JSON yang dikirim dari frontend
    $input = file_get_contents('php://input');
    
    // Simpan data ke file data.json
    // JSON_PRETTY_PRINT agar formatnya rapi seperti di Node.js
    file_put_contents($dataFile, $input);
    
    // Kirim pesan sukses
    echo json_encode(['message' => 'Data berhasil disimpan']);
}
?>