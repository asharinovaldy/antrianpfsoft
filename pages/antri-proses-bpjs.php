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
    error_reporting(0);
    include '../koneksi/koneksi.php';
    $kode = $_POST['id'];
    $harini = date('Y-m-d');


    $today = date('Y-m-d');
    //cari no antri terakhir yang berdasarkan tanggal
    $query = mysqli_query($koneksi, "SELECT MAX(no_antri) AS last FROM antrionline WHERE tgl_antri LIKE '$today%' AND No_Con='$kode'");
    $data = mysqli_fetch_row($query);
    $lastNoAntri = $data[0];

    //baca nomor urut dari no_antri terakhir
    $lastNoUrut = substr($lastNoAntri, 4);

    //nomor urut ditambah 1
    $nextNoUrut = $lastNoUrut + 1;

    //membuat format nomor transaksi berikutnya
    $nextNoAntri = "OL" . sprintf('%03s', $nextNoUrut);

    date_default_timezone_set('Asia/Makassar');
    $date = date('Y-m-d h:i:s');
    $nomor = $_POST['nomor'];
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $medis = $_POST['rekam'];
    $ktp = $_POST['ktp'];
    $set = mysqli_query($koneksi, "INSERT INTO antrionline VALUES ( 
    null,
    '$nextNoAntri',
    '$tanggal',
    '$kode',
    '$medis',
    '$nomor',
    '$ktp',
    '$date'
)");
    if ($set) {
        echo "<script language='javascript'>
        Swal.fire('Pengambilan Nomor Berhasil!','Anda akan menerima SMS yang berisi detail Antrian Anda.','success').then(function(){ window.location = 'data-antrian-bpjs.php'; })</script>";
    } else {
        echo "<script language='javascript'>
        window.alert('Gagal mengambil Nomor Antrian')</script>";
        echo "<script language='javascript'>
        location.href='halaman-user-bpjs.php'</script>";
    }
    ?>

    <?php

    $que = mysqli_query($koneksi, "SELECT hp FROM pasien WHERE no_bpjs='$nomor'");
    $antri = mysqli_fetch_row($que);

    $qq = mysqli_query($koneksi, "SELECT Nama FROM counter WHERE No_Con='$kode'");
    $yy = mysqli_fetch_row($qq);

    $anon = mysqli_query($koneksi, "SELECT * FROM antrionline WHERe no_bpjs='$nomor' AND tgl_antri='$harini'");
    $row = mysqli_fetch_row($anon);

    $uname = "rsuppusmd";
    $pass = "gosms2332";
    $nohp = $antri[0];
    $msg = "Berikut%20adalah%20informasi%20mengenai%20antrian%20Anda.%20Nomor%20Antrian%20Anda%20:%20" . $row[1] . ",%20di%20Poli%20:%20" . $yy[0] . ",%20pada%20tanggal%20:%20" . $row[2] . ",%20Nomor%20BPJS%20Anda%20:%20" . $row[5] . "%20dan%20Nomor%20Rekam%20Medis%20Anda%20:%20" . $row[4];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://api.gosmsgateway.net/api/Send.php?username=" . $uname . "&mobile=" . $nohp . "&password=" . $pass . "&message=" . $msg);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    echo $output;
    ?>



</body>


</html>