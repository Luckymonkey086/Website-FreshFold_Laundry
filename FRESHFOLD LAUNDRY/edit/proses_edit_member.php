<?php

require_once "../connection.php"; //seolah-olah semua code di koneksi.php bisa kita gunakan

// die('test');
$id_member = $_POST ['id'];
$nama_member = $_POST['nama_member'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tlp = $_POST['tlp'];

$query = mysqli_query($connection, "UPDATE tb_member SET nama='$nama_member', alamat='$alamat', jenis_kelamin='$jenis_kelamin', tlp='$tlp' WHERE id='$id_member'");

// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data Obat ".mysqli_error($connection);
} else{
    // header('Location:view_obat.php');
    // exit;

    echo "<script>location.href='../dashboard.php?page=member';</script>"; //pindah ke halaman obat jika berhasil
}