<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Pendaftaran Antrian Online</title>

  <!-- Custom fonts for this template-->
  <link href="../asset/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../asset/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../asset/css/style.css">

</head>
<?php session_start();
if (empty($_SESSION['bpjs'])) {
  header('Location: ../index.php');
}
?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">

        <div class="sidebar-brand-text mx-3">Antrian Online</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="halaman-user-bpjs.php">
          <i class="fas fa-fw fa-list"></i>
          <span>Daftar Antrian</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Antrian Anda
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-file"></i>
          <span>Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Antrian:</h6>
            <a class="collapse-item tab-menu active" href="data-antrian-bpjs.php">Antrian Anda</a>
          </div>
        </div>
      </li>



    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          SELAMAT DATANG, <?= $_SESSION['nama'] ?>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Messages -->

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-gray-600 small">LOGOUT</span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4" id="awal">
            <h1 class="h3 mb-0 text-gray-800"> DATA DIRI ANDA : </h1>
          </div>

          <div class="row">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <th>NO BPJS</th>
                <th>NAMA</th>
                <th>NO REKAM MEDIS</th>
                <th>NO KTP</th>
              </thead>
              <?php
              include '../koneksi/koneksi.php';
              $bpjs = $_SESSION['bpjs'];


              $query = mysqli_query($koneksi, "SELECT * FROM pasien WHERE no_bpjs='$bpjs'");
              while ($data = mysqli_fetch_row($query)) :
                ?>
                <td><?= $data[3]; ?></td>
                <td><?= $data[2]; ?></td>
                <td><?= $data[22]; ?></td>
                <td><?= $data[21]; ?></td>


              <?php endwhile ?>

            </table>
          </div>
          <hr>
          <!-- Content Row -->
          <div class="row">
            <br>
            <h3 class="mb-5">Silahkan Mengambil Nomor Antrian pada Poli yang Tersedia.</h3>
            <?php


            $tgl = date('Y-m-d');

            $check = mysqli_query($koneksi, "SELECT no_rm FROM antrionline WHERE no_bpjs = '$bpjs' AND tgl_antri = '$tgl'");
            $checkData = mysqli_fetch_row($check);

            //cek semua data di tabel antrionline berdasarkan no-bpjs dan tanggal hari ini dan hitung berapa hasilnya
            $cek = mysqli_query($koneksi, "SELECT * FROM antrionline WHERE no_rm='$checkData[0]' AND tgl_antri='$tgl'");
            $cekDataAntrian = mysqli_num_rows($cek);

            //menampilkan daftar poli
            $counter = mysqli_query($koneksi, "SELECT * FROM counter");
            while ($poli = mysqli_fetch_row($counter)) :

              //hitung banyaknya antrian
              $que = mysqli_query($koneksi, "SELECT COUNT(no_antri) FROM antrionline WHERE No_Con='$poli[0]' AND tgl_antri='$tgl'");
              $queue = mysqli_fetch_row($que);

              //hitung berapa maksimal pasien yang dapat dilayani di setiap poli terkait
              $m = mysqli_query($koneksi, "SELECT max_pasien FROM counter WHERE Nama='$poli[2]'");
              $max = mysqli_fetch_row($m);

              //jika antrian kurang dari batas, maka bisa mengambil antrian
              if ($queue < $max) {

                // jika pasien belum melakukan pendaftaran pada hari ini, maka bisa mendaftar
                if ($cekDataAntrian < 1) {

                  ?>
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="h5 text font-weight-bold text-primary text-uppercase mb-1"><?= $poli[2]; ?></div>
                          <p class="card-text">Silakan daftarkan diri Anda untuk mengambil nomor antrian.</p>
                          <a href="antri.php?id=<?= $poli[0]; ?>" class="btn btn-primary daftar" data-toggle="modal" data-target="#antri" data-id="<?= $poli[0]; ?>">DAFTAR ANTRIAN</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- jika sudah terdaftar, maka pasien akan mendapat pemberitahuan pada sistem bahwa pasien hanya dapat mendaftar sekali pada satu hari -->
                <?php } else { ?>

                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                      <div class="card-body">
                        <div class="h5 text font-weight-bold text-primary text-uppercase mb-1"><?= $poli[2]; ?></div>
                        <p class="card-text">Anda hanya <b> dapat mendaftar sekali </b> pada hari ini.</p>
                      </div>
                    </div>
                    <br>
                  </div>

                <?php } ?>

                <!-- jika kuota antrian pada poli penuh, maka tampilkan keterangan bahwa sudah penuh -->
              <?php } else { ?>

                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="h5 text font-weight-bold text-primary text-uppercase mb-1"><?= $poli[2]; ?></div>
                      <p class="card-text">Antrian <b> sudah penuh untuk hari ini </b>. Silahkan <b> mengambil nomor antrian </b> di <b> lain hari </b>.</p>
                    </div>
                  </div>
                  <br>
                </div>

              <?php } ?>

              <!-- akhir dari perulangan -->
            <?php endwhile ?>

          </div>

          <div class="modal fade" id="antri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Pengambilan Nomor Antrian. Silahkan mengisi <b>berdasarkan Data Diri </b> Anda</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="antri-proses-bpjs.php" method="POST">

                    <div class="form-group">
                      <label for="nomor">No. BPJS</label>
                      <input type="text" name="nomor" id="nomor" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="rekam">No. Rekam Medis </label>
                      <input type="text" name="rekam" id="rekam" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="ktp">No. KTP </label>
                      <input type="text" name="ktp" id="ktp" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="poli">Antrian di </label>
                      <input type="text" name="poli" id="poli" class="form-control" readonly>
                      <input type="hidden" id="id" name="id">
                    </div>
                    <div class="form-group">
                      <label for="tanggal">Pada tanggal </label>
                      <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?= date('d/m/Y') ?>" disabled>
                      <input type="hidden" name="tanggal" id="tanggal" value="<?= date('Y/m/d'); ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" id="tombol">Ambil Nomor</button>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">
            <!-- Content Row -->
            <div class="row">
              <!-- Content Column -->
              <div class="col-lg-6 mb-4">
              </div>
            </div>
            <!-- /.container-fluid -->

          </div>
          <!-- End of Main Content -->

          <!-- Footer -->
          <footer class="sticky-footer bg-white">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span>Copyright &copy; PFSOFT INDONESIA 2019</span>
              </div>
            </div>
          </footer>
          <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Yakin ingin Logout?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Klik Tombol Logout dibawah untuk keluar dari sesi ini :)</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap core JavaScript-->
      <script src="../asset/sbadmin/vendor/jquery/jquery.min.js"></script>
      <script src="../asset/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="../asset/js/script.js"></script>
      <script src="../asset/js/script2.js"></script>

      <!-- Core plugin JavaScript-->
      <script src="../asset/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

      <!-- Custom scripts for all pages-->
      <script src="../asset/sbadmin/js/sb-admin-2.min.js"></script>

      <!-- Page level plugins -->
      <script src="../asset/sbadmin/vendor/chart.js/Chart.min.js"></script>

      <!-- Page level custom scripts -->
      <script src="../asset/sbadmin/js/demo/chart-area-demo.js"></script>
      <script src="../asset/sbadmin/js/demo/chart-pie-demo.js"></script>

</body>

</html>