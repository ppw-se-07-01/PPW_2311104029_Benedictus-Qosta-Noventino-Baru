<?php 
// File: proses_edit.php 
// Fungsi: Memproses update data mahasiswa 
 
include "koneksi.php"; 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
     
    // Ambil data dari form 
    $nim = $_POST['nim']; 
    $nama = $_POST['nama']; 
    $jurusan = $_POST['jurusan']; 
    $email = $_POST['email']; 
    $tanggal_lahir = $_POST['tanggal_lahir']; 
     
    try {
        // Query UPDATE untuk mengubah data 
        $query = "UPDATE mahasiswa SET  
                  nama = :nama,  
                  jurusan = :jurusan,  
                  email = :email,  
                  tanggal_lahir = :tanggal_lahir  
                  WHERE nim = :nim"; 
         
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':jurusan', $jurusan);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
        $stmt->bindParam(':nim', $nim);
        
        // Eksekusi query 
        if ($stmt->execute()) { 
            echo "<script> 
                    alert('Data berhasil diupdate!'); 
                    window.location.href='tampil_data.php'; 
                  </script>"; 
        }
    } catch(PDOException $e) {
        echo "<script> 
                alert('Gagal mengupdate data: " . $e->getMessage() . "'); 
                window.location.href='form_edit.php?nim=$nim'; 
              </script>"; 
    }
} 
?> 
