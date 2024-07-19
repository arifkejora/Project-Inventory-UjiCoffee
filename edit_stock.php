<?php
session_start();
include('db_connection.php'); 

if (!isset($_SESSION['login_user'])) {
    header("location: pages-login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];

    $sql = "UPDATE stock SET nama='$nama', jenis='$jenis', stock='$stock', harga='$harga' WHERE id_stock='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("location: stok.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
