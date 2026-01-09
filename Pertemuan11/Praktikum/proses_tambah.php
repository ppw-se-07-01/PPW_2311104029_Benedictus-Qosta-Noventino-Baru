<?php 
// File: proses_tambah.php 
// Fungsi: Memproses data dari form dan menyimpan ke database 
 
include "koneksi.php"; 
 
// Cek apakah form sudah di-submit 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
     
    // Ambil data dari form 
    $nim = $_POST['nim']; 
    $nama = $_POST['nama']; 
    $jurusan = $_POST['jurusan']; 
    $email = $_POST['email']; 
    $tanggal_lahir = $_POST['tanggal_lahir']; 
     
    try {
        // Validasi: Cek apakah NIM sudah ada 
        $stmt = $conn->prepare("SELECT nim FROM mahasiswa WHERE nim = :nim");
        $stmt->bindParam(':nim', $nim);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) { 
            // NIM sudah ada 
            echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Error</title>
                <style>
                    body { font-family: Arial; text-align: center; padding: 50px; }
                    .error { color: #f44336; font-size: 20px; margin: 20px 0; }
                    .nim-box { background: #ffebee; padding: 10px; display: inline-block; border-radius: 5px; }
                    a { color: white; background: #2196F3; padding: 10px 20px; text-decoration: none; border-radius: 4px; }
                </style>
            </head>
            <body>
                <h2>❌ Gagal Menambahkan Data</h2>
                <div class='error'>NIM sudah terdaftar di database!</div>
                <div class='nim-box'>NIM: <strong>$nim</strong></div>
                <p>Silakan gunakan NIM yang lain atau cek data yang sudah ada.</p>
                <a href='tampil_data.php'>Lihat Data</a> &nbsp;
                <a href='form_tambah.php'>Input Ulang</a>
            </body>
            </html>";
            exit;
        } else { 
            // Query INSERT untuk menambah data 
            $query = "INSERT INTO mahasiswa (nim, nama, jurusan, email, tanggal_lahir)  
                      VALUES (:nim, :nama, :jurusan, :email, :tanggal_lahir)"; 
             
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nim', $nim);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':jurusan', $jurusan);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
            
            // Eksekusi query 
            if ($stmt->execute()) { 
                echo "<script> 
                        alert('✅ Data berhasil ditambahkan!'); 
                        window.location.href='tampil_data.php'; 
                      </script>"; 
            } 
        }
    } catch(PDOException $e) {
        // Tangkap error constraint violation
        if ($e->getCode() == 23000) {
            echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Error</title>
                <style>
                    body { font-family: Arial; text-align: center; padding: 50px; }
                    .error { color: #f44336; font-size: 20px; margin: 20px 0; }
                    .nim-box { background: #ffebee; padding: 10px; display: inline-block; border-radius: 5px; }
                    a { color: white; background: #2196F3; padding: 10px 20px; text-decoration: none; border-radius: 4px; }
                </style>
            </head>
            <body>
                <h2>❌ Gagal Menambahkan Data</h2>
                <div class='error'>NIM sudah terdaftar di database!</div>
                <div class='nim-box'>NIM: <strong>$nim</strong></div>
                <p>Silakan gunakan NIM yang lain atau cek data yang sudah ada.</p>
                <a href='tampil_data.php'>Lihat Data</a> &nbsp;
                <a href='form_tambah.php'>Input Ulang</a>
            </body>
            </html>";
        } else {
            echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Error</title>
                <style>
                    body { font-family: Arial; text-align: center; padding: 50px; }
                    .error { color: #f44336; }
                    a { color: white; background: #2196F3; padding: 10px 20px; text-decoration: none; border-radius: 4px; }
                </style>
            </head>
            <body>
                <h2>❌ Terjadi Kesalahan</h2>
                <p class='error'>" . $e->getMessage() . "</p>
                <a href='form_tambah.php'>Kembali</a>
            </body>
            </html>";
        }
        exit;
    }
} 
?>