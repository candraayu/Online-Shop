<?php
if (isset($_POST['submit'])) {
    $conn = connect();
    $stmt = $conn->prepare("INSERT INTO produk (name, price) VALUES (?, ?)");
    $stmt->execute([$_POST['nama'], $_POST['harga']]);

    $id = $conn->lastInsertId();
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = "produk/$id.$ext";
    move_uploaded_file($_FILES['image']['tmp_name'], $filename);
    $stmt = $conn->prepare("UPDATE produk SET image = ? WHERE id = ?");
    $stmt->execute([$filename, $id]);
}

?>
<form action="/index.php?page=tambah" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-2">
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control">
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga" class="form-control">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg, .gif, .bmp" class="form-control">
    </div>
    <input type="submit" value="submit" name="submit" class="btn btn-primary">
</form>