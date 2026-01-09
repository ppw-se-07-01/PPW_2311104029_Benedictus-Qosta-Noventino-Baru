<?php
echo "<h2>🔍 Cek Lokasi & Isi Database</h2>";
echo "<hr>";

// Cek semua kemungkinan lokasi database
$locations = [
    __DIR__ . '/akademik.db',
    dirname(__FILE__) . '/akademik.db',
    getcwd() . '/akademik.db',
    'akademik.db'
];

echo "<h3>📍 Kemungkinan Lokasi File Database:</h3>";
foreach ($locations as $i => $loc) {
    $num = $i + 1;
    echo "<p><strong>Lokasi $num:</strong> $loc<br>";
    if (file_exists($loc)) {
        echo "✅ <span style='color: green;'>FILE ADA</span> - Ukuran: " . filesize($loc) . " bytes";
        
        // Coba baca isinya
        try {
            $conn_test = new PDO("sqlite:$loc");
            $result = $conn_test->query("SELECT COUNT(*) as total FROM mahasiswa");
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo " - <strong style='color: blue;'>Jumlah data: {$row['total']}</strong>";
        } catch(Exception $e) {
            echo " - Error: " . $e->getMessage();
        }
    } else {
        echo "❌ <span style='color: red;'>File tidak ada</span>";
    }
    echo "</p>";
}

echo "<hr>";

// Cek apa yang dipakai koneksi.php
echo "<h3>🔗 Database yang Digunakan koneksi.php:</h3>";
include "koneksi.php";

$db_info = $conn->query("PRAGMA database_list")->fetch(PDO::FETCH_ASSOC);
echo "Database aktif: <strong style='color: blue;'>{$db_info['file']}</strong><br>";

$result = $conn->query("SELECT COUNT(*) as total FROM mahasiswa");
$row = $result->fetch(PDO::FETCH_ASSOC);
echo "Jumlah data di database aktif: <strong>{$row['total']}</strong><br><br>";

if ($row['total'] > 0) {
    echo "<h4>Data yang ada:</h4>";
    $result = $conn->query("SELECT * FROM mahasiswa");
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>NIM</th><th>Nama</th><th>Jurusan</th><th>Email</th></tr>";
    while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>{$data['nim']}</td><td>{$data['nama']}</td><td>{$data['jurusan']}</td><td>{$data['email']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>❌ Database KOSONG!</p>";
}

echo "<hr>";
echo "<h3>📂 Scan Semua File .db di Folder:</h3>";
$files = glob(__DIR__ . '/*.db');
if (empty($files)) {
    echo "<p>Tidak ada file .db ditemukan</p>";
} else {
    foreach ($files as $file) {
        echo "<p>📁 " . basename($file) . " - " . filesize($file) . " bytes</p>";
    }
}

echo "<hr>";
echo "<p><a href='tampil_data.php'>Kembali ke Tampil Data</a></p>";
?>