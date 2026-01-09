<?php
include "../koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];

mysqli_query($conn, "UPDATE produk
                     SET nama='$nama', harga='$harga'
                     WHERE id=$id");

header("Location: produk.php");
?>
