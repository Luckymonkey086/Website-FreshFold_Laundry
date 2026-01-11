<?php

// die('test');
include "../connection.php";
// $id_obat = $_POST['id_obat'];
$nama_outlet = $_POST['nama_outlet'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];
$query = mysqli_query($connection, "INSERT INTO tb_outlet VALUES (NULL,'$nama_outlet','$alamat','$telp')");

// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data Outlet ".mysqli_error($connection);
}else{
    // header('Location:../select/view_obat.php');
    // exit;

    echo "<script>location.href='../dashboard.php?page=outlet';</script>"; //pindah ke halaman obat jika berhasil
}

echo "berhasil";