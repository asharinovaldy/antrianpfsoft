<?php
session_start();
include '../koneksi/koneksi.php';
// $kode = $_POST['id'];


// $query = mysqli_query($koneksi, "SELECT * FROM counter WHERE No_Con='$kode'");
// $data = mysqli_fetch_assoc($query);

$bpjs = $_SESSION['bpjs'];
$no = $_POST['filter'];
$query2 = mysqli_query($koneksi, "SELECT * FROM pasien WHERE no_bpjs='$no'");
$pasien = mysqli_fetch_assoc($query2);

// echo json_encode($data);
echo json_encode($pasien);
