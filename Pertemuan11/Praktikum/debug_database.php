<?php
// File untuk debug database
echo "<h2>Debug Database SQLite</h2>";
echo "<hr>";

// Cek apakah file database ada
$db_path = __DIR__ . '/akademik.db';
echo "<h3>1. Cek File Database</h3>";
if (file_exists($db_path)) {
    echo "✅ File database ada di: <strong>$db_path</strong><br>";
    echo "Ukuran file: " . filesize($db_path) . " bytes<br>";
} else {
    echo "❌ File database TIDAK ditemukan!<br>";
}

echo "<hr>";

// Coba koneksi
echo "<h3>2. Cek Koneksi Database</h3>";
try {
    include "koneksi.php";
    echo "✅ Koneksi berhasil!<br>";
    
    // Cek struktur tabel
    echo "<hr>";
    echo "<h3>3. Struktur Tabel Mahasiswa</h3>";
    $stmt = $conn->query("PRAGMA table_info(mahasiswa)");
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Nama Kolom</th><th>Tipe</th><th>Not Null</th><th>Default</th><th>Primary Key</th></tr>";
    while ($column = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$column['cid']}</td>";
        echo "<td><strong>{$column['name']}</strong></td>";
        echo "<td>{$column['type']}</td>";
        echo "<td>{$column['notnull']}</td>";
        echo "<td>{$column['dflt_value']}</td>";
        echo "<td>{$column['pk']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Cek jumlah data
    echo "<hr>";
    echo "<h3>4. Isi Database</h3>";
    $result = $conn->query("SELECT COUNT(*) as total FROM mahasiswa");
    $row = $result->fetch(PDO::FETCH_ASSOC);
    echo "Total data: <strong>{$row['total']}</strong> record<br><br>";
    
    // Tampilkan semua data
    if ($row['total'] > 0) {
        $result = $conn->query("SELECT * FROM mahasiswa ORDER BY nim ASC");
        echo "<table border='1' cellpadding='5' style='width:100%'>";
        echo "<tr><th>NIM</th><th>Nama</th><th>Jurusan</th><th>Email</th><th>Tanggal Lahir</th></tr>";
        while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$data['nim']}</td>";
            echo "<td>{$data['nama']}</td>";
            echo "<td>{$data['jurusan']}</td>";
            echo "<td>{$data['email']}</td>";
            echo "<td>{$data['tanggal_lahir']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red;'>❌ Database kosong! Belum ada data.</p>";
        echo "<p><a href='insert_sample_data.php'>Klik di sini untuk insert data sample</a></p>";
    }
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}

echo "<hr>";
echo "<p><a href='tampil_data.php'>Kembali ke Tampil Data</a></p>";
?>
