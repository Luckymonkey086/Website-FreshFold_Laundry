<?php

// die('test');
include "../connection.php";
// $id_obat = $_POST['id_obat'];
$nama_outlet = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$telp = $_POST['telp'];
$query = mysqli_query($connection, "INSERT INTO tb_member VALUES (NULL,'$nama_outlet','$alamat', '$jenis_kelamin','$telp')");

// var_dump($query);
if(!$query){
    echo "Gagal Memasukkan Data Member ".mysqli_error($connection);
}else{
    // header('Location:../select/view_obat.php');
    // exit;

    echo "<script>location.href='../dashboard.php?page=member';</script>"; //pindah ke halaman obat jika berhasil
}

echo "berhasil";