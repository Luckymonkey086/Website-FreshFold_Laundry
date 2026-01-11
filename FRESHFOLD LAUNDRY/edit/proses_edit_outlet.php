<?php

require_once "../connection.php"; //seolah-olah semua code di koneksi.php bisa kita gunakan

// die('test');
$id_outlet = $_POST ['id'];
$nama_outlet = $_POST['nama_outlet'];
$alamat = $_POST['alamat'];
$tlp = $_POST['tlp'];

$query = mysqli_query($connection, "UPDATE tb_outlet SET nama='$nama_outlet', alamat='$alamat',tlp='$tlp' WHERE id='$id_outlet'");

// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data Obat ".mysqli_error($connection);
} else{
    // header('Location:view_obat.php');
    // exit;

    echo "<script>location.href='../dashboard.php?page=outlet';</script>"; //pindah ke halaman obat jika berhasil
}