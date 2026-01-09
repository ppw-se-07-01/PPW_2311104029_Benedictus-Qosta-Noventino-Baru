<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

<h3>Tambah Produk</h3>

<form action="proses_tambah.php" method="POST" enctype="multipart/form-data">

  Nama:
  <input type="text" name="nama" class="form-control" required>

  Harga:
  <input type="number" name="harga" class="form-control" required>

  Gambar:
  <input type="file" name="gambar" class="form-control" required>

  <button class="btn btn-success mt-3">Simpan</button>

</form>

</body>
</html>
