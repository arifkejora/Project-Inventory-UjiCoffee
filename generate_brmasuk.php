<?php
session_start();
include('db_connection.php');
require('fpdf/fpdf.php'); 

if (!isset($_SESSION['login_user'])) {
    header("location: pages-login.php");
    exit;
}

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
    $pdf->Cell(0, 10, 'Rekap Barang Masuk', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C', true);
    $pdf->Cell(30, 7, 'Tanggal', 1, 0, 'C', true);
    $pdf->Cell(50, 7, 'Nama Barang', 1, 0, 'C', true);
    $pdf->Cell(30, 7, 'Jumlah', 1, 0, 'C', true);
    $pdf->Cell(70, 7, 'Keterangan', 1, 1, 'C', true);

    $sql = "SELECT bm.tgl, s.nama, bm.jumlah, bm.keterangan 
            FROM brg_masuk bm 
            JOIN stock s ON bm.id_stock = s.id_stock";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $no = 1;
        while($row = $result->fetch_assoc()) {
            $pdf->Cell(10, 7, $no++, 1, 0, 'C');
            $pdf->Cell(30, 7, date("d F Y", strtotime($row['tgl'])), 1, 0);
            $pdf->Cell(50, 7, $row['nama'], 1, 0);
            $pdf->Cell(30, 7, $row['jumlah'], 1, 0, 'C');
            $pdf->Cell(70, 7, $row['keterangan'], 1, 1);
        }
    } else {
        $pdf->Cell(0, 10, 'Tidak ada data barang masuk', 1, 1, 'C');
    }

    $pdf->Output();
}

// Call the function to generate the PDF
generateStockPDF($conn);
?>
