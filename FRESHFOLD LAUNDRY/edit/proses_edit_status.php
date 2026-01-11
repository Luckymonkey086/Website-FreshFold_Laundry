<?php
include "../connection.php";
$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($connection, "UPDATE tb_transaksi SET status='$status' WHERE id='$id'");

echo "<script>window.location.href='../dashboard.php?page=detail_transaksi'</script>";
?>