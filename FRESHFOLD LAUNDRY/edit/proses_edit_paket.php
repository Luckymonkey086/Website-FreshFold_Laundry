<?php

require_once "../connection.php"; 

$id_paket = $_POST ['id'];
$nama_paket = $_POST['nama_paket'];
$jenis = $_POST['jenis'];
$outlet= $_POST['outlet'];
$harga = $_POST['harga'];

$query = mysqli_query($connection, "UPDATE tb_paket SET nama_paket='$nama_paket', jenis='$jenis', id_outlet='$outlet', harga='$harga' WHERE id='$id_paket'");

if(!$query){
    echo "Gagal Memasukkan Data paket ".mysqli_error($connection);
} else{
 
    echo "<script>location.href='../dashboard.php?page=paket';</script>"; 
}