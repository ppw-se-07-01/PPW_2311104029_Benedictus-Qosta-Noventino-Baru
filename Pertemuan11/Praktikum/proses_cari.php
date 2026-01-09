<?php 
// File: proses_cari.php 
// Fungsi: Logika pencarian data mahasiswa 
 
function cariMahasiswa($conn, $keyword) 
{ 
    // Query dengan LIKE untuk pencarian menggunakan prepared statement
    $query = "SELECT * FROM mahasiswa  
              WHERE nim LIKE :keyword  
              OR nama LIKE :keyword  
              OR jurusan LIKE :keyword 
              ORDER BY nim ASC"; 
 
    $stmt = $conn->prepare($query);
    $searchKeyword = "%$keyword%";
    $stmt->bindParam(':keyword', $searchKeyword);
    $stmt->execute();
    
    // Return sebagai array, bukan statement
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 
 
function hitungHasilCari($result) 
{ 
    // Result sekarang adalah array, bukan statement
    return count($result); 
}