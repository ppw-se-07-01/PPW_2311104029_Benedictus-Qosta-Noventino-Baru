<?php 
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BikeShop Official - Pusat Sepeda Roadbike</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
      /* Style tambahan agar gambar kartu seragam */
      .card-img-top {
        height: 250px;
        object-fit: cover;
        object-position: center;
      }
      .card {
        transition: transform 0.2s;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      }
      .card:hover {
        transform: translateY(-5px);
      }
      .navbar-brand {
        letter-spacing: 1px;
      }
    </style>
  </head>

  <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="fas fa-bicycle me-2"></i>BIKESHOP
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link active" href="index.php">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Katalog</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Promo</a></li>
            
            <li class="nav-item ms-lg-3">
                <a class="btn btn-outline-light btn-sm mt-1" href="admin/produk.php">Kelola Produk (Admin)</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div id="carouselExample" class="carousel slide shadow-sm" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/image/roadbike1.jpg" class="d-block w-100" style="height:450px; object-fit:cover; filter: brightness(70%);">
          <div class="carousel-caption d-none d-md-block">
            <h2>Roadbike Kualitas Premium</h2>
            <p>Jelajahi jalanan dengan kecepatan maksimal.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/image/roadbike2.jpg" class="d-block w-100" style="height:450px; object-fit:cover