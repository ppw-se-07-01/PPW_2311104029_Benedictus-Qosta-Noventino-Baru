<?php
include "../koneksi.php";

$nama = $_POST['nama'];
$harga = $_POST['harga'];

$gambar = $_FILES['gambar']['name'];
$lokasi = $_FILES['gambar']['tmp_name'];

move_uploaded_file($lokasi, "../assets/image/" . $gambar);

mysqli_query($conn, "INSERT INTO produk(nama, harga, gambar)
                     VALUES('$nama', '$harga', '$gambar')");

header("Location: produk.php");
?>
