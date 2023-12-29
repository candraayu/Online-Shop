<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$conn = connect();
$stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->execute([$id]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$produk = $stmt->fetch();

if (isset($_POST['submit'])) {
    $conn = connect();
    $stmt2 = $conn->prepare("DELETE FROM produk WHERE id = ?");
    $stmt2->execute([$id]);
    header('Location: /index.php');
}
if (isset($_GET['action']) && $_GET['action'] == 'addToCart') {

    //cek apakah produk sudah ada di kranjang
    //jika belum ada, maka tammbahkan qty
    //jika belum ada, maka tambahkan produk ke keranjang

    $ditemukan = false;
    foreach ($_SESSION['cart'] as $key => $cart) {
        if ($cart['id'] == $produk['id']) {
            $cart['qty']++;
            $_SESSION['cart'][$key] = $cart;
            $ditemukan = true;
        }
    }
    if ($ditemukan == false) {
        $_SESSION['cart'][] = [
            'id' => $_GET['id'],
            'qty' => 1,
            'name' => $produk['name'],
            'image' => $produk['image'],
            'price' => $produk['price'],

        ];
    }
}

//produk

?>
<div class="col-sm-4">
    <div class="card text-center">
        <img src="<?php echo $produk['image'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $produk['name'] ?></h5>
            <p class="card-text">Rp.<?php echo number_format($produk['price'], 3) ?></p>
            <a href="/index.php?page=detail&id=<?php echo $produk['id'] ?>&action=addToCart" class="btn btn-outline-primary d-grid mt-2">Add To Cart</a>
            <a href="/index.php?page=update&id=<?php echo $produk['id'] ?>" class="btn btn-outline-success d-grid mt-2">Edit</a>
            <form action="/index.php?page=detail&id=<?php echo $produk['id'] ?>" method="post" class="d-flex flex-column gap-1 mt-1 ">
                <input type="submit" value="Hapus" name="submit" class="btn btn-outline-danger">
            </form>
        </div>
    </div>
</div>