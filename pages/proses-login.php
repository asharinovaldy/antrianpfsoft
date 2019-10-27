<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proses</title>

    <script src="../asset/js/jquery-3.3.1.min.js"></script>
    <script src="../asset/js/sweetalert2.all.min.js"></script>

</head>

<body>
    <?php
    session_start();
    include '../koneksi/koneksi.php';

    $bpjs = mysqli_real_escape_string($koneksi, $_POST['bpjs']);
    $password = mysqli_real_escape_string($koneksi, $_POST['pass']);

    $query = mysqli_query($koneksi, "SELECT * FROM pasien where no_bpjs='$bpjs' or rm_file='$bpjs' or no_ktp = '$bpjs' and password='$password'");
    $cek = mysqli_num_rows($query);
    $data = mysqli_fetch_row($query);

    if ($cek > 0) {
        //bpjs
        if ($data[3] == $bpjs and $data[5] == $password) {
            $_SESSION['nama'] = $data[2];
            $_SESSION['bpjs'] = $bpjs;
            // $_SESSION['rm'] = $bpjs;
            // $_SESSION['ktp'] = $bpjs;
            header('location:halaman-user-bpjs.php');
            //ktp
        } elseif ($data[21] == $bpjs and $data[5] == $password) {
            $_SESSION['nama'] = $data[2];
            $_SESSION['ktp'] = $bpjs;
            // $_SESSION['rm'] = $bpjs;
            // $_SESSION['ktp'] = $bpjs;
            header('location:halaman-user-ktp.php');
            //rekam medis
        } elseif ($data[22] == $bpjs and $data[5] == $password) {
            $_SESSION['nama'] = $data[2];
            $_SESSION['rm'] = $bpjs;
            // $_SESSION['rm'] = $bpjs;
            // $_SESSION['ktp'] = $bpjs;
            header('location:halaman-user-rm.php');
        } else {
            echo "<script language='javascript'>
        Swal.fire('Gagal Login! ','BPJS, Rekam Medik atau Password Anda Salah!','error').then(function(){ window.location = '../index.php'; })</script>";
        }
    } else {
        echo "<script language='javascript'>
    Swal.fire('Anda Belum Terdaftar','Silahkan Mendaftar terlebih dahulu!','error').then(function(){ window.location = '../index.php'; })</script>";
    }
    ?>

</body>


</html>