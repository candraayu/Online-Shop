<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';

include_once "koneksi.php";
session_start();
if (isset($_GET['action']) && $_GET['action'] == 'logout')  {
  unset($_SESSION['userId']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chaa Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="stylehome.css">
  <script src="https://kit.fontawesome.com/a79305f202.js" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="carousel/logo store.png" alt="Logo" width="65px" height="65px" class="me-2">
        <strong>Chaa Store</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <form class="d-flex ms-auto" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-light" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/index.php">Beranda</a>
          </li>
          <?php if (isset($_SESSION['userId'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="/index.php?action=logout">Keluar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/index.php?page=keranjang">Keranjang</a>
          </li>
          <?php else :?>
          <li class="nav-item">
            <a class="nav-link" href="/index.php?page=login">Masuk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/index.php?page=register">Daftar</a>
          </li>
        <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <?php
    switch ($page) {
      case 'detail':
        include "detail.php";
        break;

      case 'kategori':
        include "kategoriProduk.php";
        break;

      case 'tambah':
        include "tambah.php";
        break;

      case 'update':
        include "update.php";
        break;

      case 'keranjang':
        include "keranjang.php";
        break;

      case 'register':
        include "register.php";
        break;

      case 'login':
        include "login.php";
        break;
    
        case 'home':
          include "home.php";
          break;

      default:
      if (isset($_SESSION['userId'])) {
        include "home.php";
      } else {
        include "login.php";
      }
        
        break;
    }
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>