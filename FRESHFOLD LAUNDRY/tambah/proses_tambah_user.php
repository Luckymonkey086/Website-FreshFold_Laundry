<?php
include "../connection.php";

$id = $_POST['id_outlet'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$role = $_POST['role']; 

$pass_hash = password_hash($password, PASSWORD_DEFAULT); //enkripsi password

$query_username = mysqli_query($connection, "SELECT COUNT(*) FROM tb_user WHERE username='$username'");
$cek_username = mysqli_fetch_row($query_username);

if($password !== $password2){
    echo"<script> alert('Password tidak sama');window.location.href='../dashboard.php?page=tambah_user'</script>";
    return false;
}
if($cek_username['0'] != 0){
    echo "<script>alert('Username sudah ada, silahkan menggunakan username yang lain');window.location.href='../dashboard.php?page=tambah_user'</script>";
    return false;
}else{
    $query = "INSERT INTO tb_user VALUES('', '$nama', '$username', '$pass_hash', '$id', '$role')";
    $hasil = mysqli_query($connection, $query);
    
    if(!$hasil){
        echo "Gagal Register : ". mysqli_error($connection);
    }else{
        echo "<script>location.href='../dashboard.php?page=user';</script>";
        exit;
    } 
}

?>