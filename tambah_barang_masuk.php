<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['login_user'])) {
    header("location: barangmasuk.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_stock = $_POST['id_stock'];
    $tgl = $_POST['tgl'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $insert_query = "INSERT INTO brg_masuk (id_stock, tgl, jumlah, keterangan) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("isss", $id_stock, $tgl, $jumlah, $keterangan);

    if ($stmt->execute()) {
        // Update stock
        $update_query = "UPDATE stock SET stock = stock + ? WHERE id_stock = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ii", $jumlah, $id_stock);

        if ($stmt->execute()) {
            header("location: barangmasuk.php");
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
