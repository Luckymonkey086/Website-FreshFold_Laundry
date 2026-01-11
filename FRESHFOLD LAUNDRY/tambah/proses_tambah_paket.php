<?php

// die('test');
include "../connection.php";
// $id_obat = $_POST['id_obat'];
$nama_paket= $_POST['nama_paket'];
$jenis = $_POST['jenis'];
$outlet = $_POST['outlet'];
$harga = $_POST['harga'];
$query = mysqli_query($connection, "INSERT INTO tb_paket VALUES (NULL,'$outlet','$jenis','$nama_paket','$harga')");

// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data Outlet ".mysqli_error($connection);
}else{
    // header('Location:../select/view_obat.php');
    // exit;

    echo "<script>location.href='../dashboard.php?page=paket';</script>"; //pindah ke halaman obat jika berhasil
}

echo "berhasil";