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
    $pdf->Cell(0, 10, 'Rekap Barang Keluar', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C', true);
    $pdf->Cell(30, 7, 'Tanggal', 1, 0, 'C', true);
    $pdf->Cell(80, 7, 'Nama Barang', 1, 0, 'C', true);
    $pdf->Cell(0, 7, 'Jumlah', 1, 1, 'C', true);

    $sql = "SELECT bk.tgl, s.nama, bk.jumlah 
            FROM brg_keluar bk 
            JOIN stock s ON bk.id_stock = s.id_stock";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $no = 1;
        while($row = $result->fetch_assoc()) {
            $pdf->Cell(10, 7, $no++, 1, 0, 'C');
            $pdf->Cell(30, 7, date("d F Y", strtotime($row['tgl'])), 1, 0);
            $pdf->Cell(80, 7, $row['nama'], 1, 0);
            $pdf->Cell(0, 7, $row['jumlah'], 1, 1, 'C');
        }
    } else {
        $pdf->Cell(0, 10, 'Tidak ada data barang keluar', 1, 1, 'C');
    }

    $pdf->Output();
}

generateStockPDF($conn);
?>
