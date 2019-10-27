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
<?php session_start(); ?>

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
                <a class="nav-link" href="halaman-user-ktp.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Daftar Antrian</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Antrian
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Anda:</h6>
                        <a class="collapse-item tab-menu" href="data-antrian-ktp.php">Antrian Anda</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


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

                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Content Row -->
                        <div class="row">
                            <!-- Content Column -->
                            <div class="col-lg-12">
                                <p>Dibawah ini adalah daftar antrian Anda pada hari ini. </p>
                                <table class="table table-striped table-bordered ">
                                    <thead>
                                        <th>Nomor Antrian</th>
                                        <th>Tanggal Antrian</th>
                                        <th>Poli</th>
                                        <th>No. Rekam Medis</th>
                                        <th>Nomor BPJS</th>

                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../koneksi/koneksi.php';
                                        $date = date('Y-m-d');

                                        $ktp = $_SESSION['ktp'];

                                        $check = mysqli_query($koneksi, "SELECT no_rm FROM antrionline WHERE no_ktp = '$ktp' AND tgl_antri = '$date'");
                                        $checkData = mysqli_fetch_row($check);

                                        $query = mysqli_query($koneksi, "SELECT * FROM antrionline WHERE no_rm='$checkData[0]' AND tgl_antri='$date'");
                                        while ($res = mysqli_fetch_row($query)) :

                                            $qq = mysqli_query($koneksi, "SELECT Nama FROM counter WHERE No_Con='$res[3]'");
                                            $poli = mysqli_fetch_row($qq);

                                            ?>

                                            <tr>

                                                <td><?= $res[1] ?></td>
                                                <td><?= $res[2] ?></td>
                                                <td><?= $poli[0] ?></td>
                                                <td><?= $res[4] ?></td>
                                                <td><?= $res[5] ?></td>

                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->


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