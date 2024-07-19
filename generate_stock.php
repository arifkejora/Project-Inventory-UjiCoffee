<?php
session_start();
include('db_connection.php');
require('fpdf/fpdf.php'); 

if (!isset($_SESSION['login_user'])) {
    header("location: pages-login.php");
    exit;
}

// Function to generate PDF for stock data
function generateStockPDF($conn) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Uji Coffee', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 5, 'Jalan Raya Taman Adiyasa Kel Cikuya kec. Solear kab. Tangerang', 0, 'C');
    $pdf->Ln(5);

    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Rekap Stok Barang', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C', true);
    $pdf->Cell(70, 7, 'Nama Barang', 1, 0, 'C', true);
    $pdf->Cell(30, 7, 'Jenis', 1, 0, 'C', true);
    $pdf->Cell(30, 7, 'Stok', 1, 0, 'C', true);
    $pdf->Cell(50, 7, 'Harga', 1, 1, 'C', true);

    $sql = "SELECT id_stock, nama, jenis, stock, harga FROM stock";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $no = 1;
        while($row = $result->fetch_assoc()) {
            $pdf->Cell(10, 7, $no++, 1, 0, 'C');
            $pdf->Cell(70, 7, $row['nama'], 1, 0);
            $pdf->Cell(30, 7, $row['jenis'], 1, 0);
            $pdf->Cell(30, 7, $row['stock'], 1, 0, 'C');
            $pdf->Cell(50, 7, 'Rp. ' . number_format($row['harga'], 0, ',', '.'), 1, 1, 'C');
        }
    } else {
        $pdf->Cell(0, 10, 'Tidak ada data stok barang', 1, 1, 'C');
    }

    $pdf->Output();
}

generateStockPDF($conn);
?>
