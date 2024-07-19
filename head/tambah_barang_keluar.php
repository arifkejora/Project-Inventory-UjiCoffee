<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['login_user'])) {
    header("location: barangkeluar.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_stock = $_POST['id_stock'];
    $tgl = $_POST['tgl'];
    $jumlah = $_POST['jumlah'];

    $insert_query = "INSERT INTO brg_keluar (id_stock, tgl, jumlah) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iss", $id_stock, $tgl, $jumlah); 

    if ($stmt->execute()) {
        $update_query = "UPDATE stock SET stock = stock - ? WHERE id_stock = ?";
        $stmt_update = $conn->prepare($update_query);
        $stmt_update->bind_param("ii", $jumlah, $id_stock);

        if ($stmt_update->execute()) {
            header("location: barangkeluar.php");
            exit;
        } else {
            echo "Error updating stock: " . $conn->error;
        }
    } else {
        echo "Error inserting record: " . $conn->error;
    }

    $conn->close();
}
?>
