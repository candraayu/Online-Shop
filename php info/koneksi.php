<?php
function connect()
{
    $host = "127.0.0.1";
    $username = "root";
    $password = "chandra2005";
    $conn = new PDO("mysql:host=$host;dbname=toko-online", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
?>