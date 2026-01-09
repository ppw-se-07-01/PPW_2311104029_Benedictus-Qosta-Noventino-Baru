<?php
include "../koneksi.php";
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id=$id"));
?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

<h3>Edit Produk</h3>

<form method="POST" action="proses_edit.php">
  <input type="hidden" name="id" value="<?= $data['id'] ?>">

  Nama:
  <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>">

  Harga:
  <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>">

  <button class="btn btn-primary mt-3">Update</button>

</form>

</body>
</html>
