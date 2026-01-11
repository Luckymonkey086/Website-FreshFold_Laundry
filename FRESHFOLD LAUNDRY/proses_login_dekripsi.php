    <?php
    include "connection.php";
    session_start();
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($connection, "SELECT * FROM tb_user WHERE username='$user'");
    $baris_level = mysqli_fetch_assoc($query);

    if($baris_level && password_verify($pass, $baris_level['password'])){ 
        $_SESSION['username'] = $user;
        $_SESSION['role'] = $baris_level['role'];
        $_SESSION['id_user'] =$baris_level['id'];
        $_SESSION['id_outlet'] = $baris_level['id_outlet'];
        echo "<script>alert('Berhasil Login');window.location.href='dashboard.php'</script>";
    }else{
        echo "<script>alert('Password salah');window.location.href='index.php'</script>";
    }
    ?>
