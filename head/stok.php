<?php
session_start();
include('db_connection.php'); 

if (!isset($_SESSION['login_user'])) {
    header("location: pages-login.php");
    exit;
}

$sql = "SELECT COUNT(*) AS total_stok FROM stock";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_stock = $row['total_stok'];

$sql = "SELECT id_stock, nama, jenis, stock, harga FROM stock";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">UjiCoffee Inventory</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['login_user']; ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="stok.php">
          <i class="bi bi-journal-text"></i>
          <span>Stok Barang</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="barangmasuk.php">
          <i class="bi bi-journal-text"></i>
          <span>Barang Masuk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="barangkeluar.php">
          <i class="bi bi-journal-text"></i>
          <span>Barang Keluar</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="staff.php">
          <i class="bi bi-person"></i>
          <span>Kelola Staff</span>
        </a>
      </li>
    </ul>
  </aside>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Stok Barang</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Stok Barang</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <br>
      <button type="button" class="btn btn-success mb-3" onclick="window.location.href='generate_stock.php'">
        <i class="fas fa-download"></i> Download Laporan
      </button>
                <table id="stockTable" class="table">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Jenis</th>
                      <th>Stock</th>
                      <th>Harga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["jenis"] . "</td>";
                        echo "<td>" . $row["stock"] . "</td>";
                        echo "<td>" . $row["harga"] . "</td>";
                      }
                    } else {
                      echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }
                    $conn->close();
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Edit Stok Barang</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="editForm" method="POST" action="edit_stock.php">
                <input type="hidden" id="edit-id" name="id">
                <div class="mb-3">
                  <label for="edit-nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="edit-nama" name="nama">
                </div>
                <div class="mb-3">
                  <label for="edit-jenis" class="form-label">Jenis</label>
                  <input type="text" class="form-control" id="edit-jenis" name="jenis">
                  </div>
                  <div class="mb-3">
            <label for="edit-stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="edit-stock" name="stock">
          </div>
          <div class="mb-3">
            <label for="edit-harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="edit-harga" name="harga">
          </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <p>Anda yakin ingin menghapus data ini?</p>
      <form id="deleteForm" method="POST" action="delete_stock.php">
        <input type="hidden" id="delete-id" name="id">
        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </form>
    </div>
  </div>
</div>
</div>



 <!-- Tambah Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Stock Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="tambah_stock_barang.php">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Barang</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


</section>
</main>

<footer id="footer" class="footer">
<div class="copyright">
  &copy; Copyright <strong><span>Uji Coffee</span></strong>. All Rights Reserved
</div>
<div class="credits">
  Designed by <a href="#">Artadevnymous</a>
</div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/js/main.js"></script>

<script>
document.querySelectorAll('.editBtn').forEach(item => {
  item.addEventListener('click', function(event) {
    const id = this.getAttribute('data-id');
    const nama = this.getAttribute('data-nama');
    const jenis = this.getAttribute('data-jenis');
    const stock = this.getAttribute('data-stock');
    const harga = this.getAttribute('data-harga');

    document.getElementById('edit-id').value = id;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('edit-jenis').value = jenis;
    document.getElementById('edit-stock').value = stock;
    document.getElementById('edit-harga').value = harga;
  });
});

document.querySelectorAll('.deleteBtn').forEach(item => {
  item.addEventListener('click', function(event) {
    const id = this.getAttribute('data-id');
    document.getElementById('delete-id').value = id;
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

  document.querySelectorAll('.deleteBtn').forEach(item => {
    item.addEventListener('click', function(event) {
      const id = this.getAttribute('data-id');
      document.getElementById('delete-id').value = id;
      deleteModal.show();
    });
  });

  document.getElementById('deleteForm').addEventListener('submit', function(event) {
  });
});

</script>

</body>
</html>

