<?php include "../koneksi.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h3>Kelola Produk</h3>
<a href="tambah.php" class="btn btn-success mb-3">Tambah Produk</a>

<form method="GET" class="mb-3">
    <input type="text" name="keyword" placeholder="Cari produk..." class="form-control">
</form>

<div class="row g-3">
<?php
if (isset($_GET['keyword'])) {
    $k = $_GET['keyword'];
    $query = "SELECT * FROM produk WHERE nama LIKE '%$k%'";
} else {
    $query = "SELECT * FROM produk ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);

while ($p = mysqli_fetch_assoc($result)) :
?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="card text-center">
            <img src="../assets/image/<?= $p['gambar'] ?>" class="card-img-top" style="height:180px; object-fit:cover;">
            <div class="card-body">
                <h5><?= $p['nama'] ?></h5>
                <p class="text-danger fw-bold">Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>

                <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a onclick="return confirm('Hapus produk ini?')" href="hapus.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
            </div>
        </div>
    </div>
<?php endwhile; ?>
</div>

</body>
</html>
