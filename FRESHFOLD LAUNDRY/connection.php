<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database_name= "db_laundry";

    $connection = mysqli_connect($hostname, $username, $password, $database_name);

    if(!$connection){
        echo '<script>alert("connection has failed")</script>'; 
        die();
    }
    // else{
    //     echo '<script>alert("connection has succeed")</script>'; 
    // }
?>