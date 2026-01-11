<?php
include "../connection.php";
$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$pass_hash = password_hash($password, PASSWORD_DEFAULT);
$id_outlet = $_POST['id_outlet'];
$role = $_POST['role'];


$query = mysqli_query($connection, "UPDATE tb_user SET nama='$nama', username='$username', password='$pass_hash', id_outlet='$id_outlet', role='$role' WHERE id='$id'");


if (!$query) {
    echo "Gagal Mengedit Data User" . mysqli_error($connection);
} else {
    echo "<script>location.href='../dashboard.php?page=user';</script>";
}