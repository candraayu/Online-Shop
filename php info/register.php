<?php
if (isset($_POST['submit'])) {
    $conn = connect();
    //ambil password dari $_POST, simpan ke variabel $password
    $password = $_POST['password'];
    // Hash Password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    //lakukan koneksi database seperti biasa
    //buat query seperti biasa
    //simpan
    $stmt = $conn->prepare("INSERT INTO user (nama, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['nama'], $_POST['email'],  $hashed_password ]);
}

?>

<h3 class="m-5 title">Register</h3>
<form action="/index.php?page=register" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-2">
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" name="password" id="password" class="form-control">
    </div>
    <input type="submit" value="submit" name="submit" class="btn btn-primary">
</form>