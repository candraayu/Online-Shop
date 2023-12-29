<?php
$conn = connect();
//produk
$stmt = $conn->prepare("SELECT * FROM produk");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$products = $stmt->fetchAll();

?>


<!--Carausel-->
<div class="container">
  <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="carousel/img1.jpg" class="d-block" alt="...">
      </div>
      <div class="carousel-item">
        <img src="carousel/img2.jpg" class="d-block" alt="...">
      </div>
      <div class="carousel-item">
        <img src="carousel/img3.jpg" class="d-block" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
<!--Carousel-->


<!--produk-->
<div class="container mt-5">
  <div class="judul-kategori">
    <h5 class="text-center">PRODUK TERBARU</h5>
    
      <a href="/index.php?page=tambah" class="btn btn-outline-info">Tambah</a>

    <div class="row">
      <?php foreach ($products as $key => $produk) : ?>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mt-2">
          <div class="card text-center">
            <img src="<?php echo $produk['image'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $produk['name'] ?></h5>
              <p class="card-text">Rp.<?php echo number_format($produk['price'], 3) ?></p>
              <a href="/index.php?page=detail&id=<?php echo $produk['id'] ?>" class="btn btn-primary d-grid">Detail</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<!--produk-->