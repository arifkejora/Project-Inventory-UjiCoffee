<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['login_user'])) {
    header("location: barangkeluar.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];

    $insert_query = "INSERT INTO stock (nama, jenis, stock, harga) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssii", $nama, $jenis, $stock, $harga);

    if ($stmt->execute()) {
        header("location: stok.php");
        exit;
    } else {
        echo "Error inserting record: " . $conn->error;
    }

    $conn->close();
}
?>
