<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$conn = connect();
$stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->execute([$id]);

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$produk  = $stmt->fetch();
if (isset($_POST['submit'])) {
    $conn = connect();
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = "produk/$id.$ext";
    unlink($filename);
    move_uploaded_file($_FILES['image']['tmp_name'], $filename);
    $stmt2 = $conn->prepare("UPDATE produk SET name = ?, price = ?, image = ? WHERE id = $id");
    $stmt2->execute([$_POST['nama'], $_POST['harga'],$filename]);
}
?>
<h3>Silahkan Edit Produk Terbaru dengan id <?php echo "$id" ?> ini Dengan Mengisi Form Dibawah</h3>
<form action="/index.php?page=update&id=<?php echo $produk['id'] ?>" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-2 m-5">
    <div class="form-group">
        <label for="Nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?php echo $produk['name'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="Harga">Harga</label>
        <input type="number" name="harga" id="harga" value="<?php echo $produk['price'] ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="Image">Image</label>
        <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg, .gif, .bmp" value="<?php echo $produk['image'] ?>"  class="form-control">
    </div>
    <input type="submit" value="submit" name="submit" class="btn btn-primary">
</form>