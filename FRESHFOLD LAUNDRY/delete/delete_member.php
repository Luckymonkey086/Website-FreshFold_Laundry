<?php
    include "../connection.php";
    $id = $_GET['id'];
    $query_delete = mysqli_query($connection, "DELETE FROM tb_member WHERE id=$id");

    if(!$query_delete){
        echo "Gagal delete".mysqli_error($connection);
    }else{
        header('Location:../dashboard.php?page=member');
    }
?>