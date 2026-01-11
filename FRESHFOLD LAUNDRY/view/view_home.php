<?php
$id_user = $_SESSION['id_user']; // Ambil ID pengguna yang sedang masuk dari session

$outlet = mysqli_query($connection, "SELECT tb_outlet.nama 
                                     FROM tb_outlet 
                                     INNER JOIN tb_user ON tb_outlet.id = tb_user.id_outlet 
                                     WHERE tb_user.id = '$id_user'");
$outletnya = mysqli_fetch_array($outlet);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>


        .main{
            position: relative;
            width: 100%;
        }
        .main-top{
            /* background-color: chocolate;
            color: white;    */
            background-color: white;
            padding: 20px;
            padding-left: 300px;
             font-size: 18px;
        }
        .main-welcome{
            display: flex;
            margin-top: 20px;
        }   
        .main-welcome .card-user{
            width: 55vh;
            height: 70vh;
            margin: 50px;
            margin-left: 400px;
            background: #fff;
            text-align: center;
            border-radius: 20px;
            padding: 20px;
                box-shadow: 0 20px 35px black;
            word-break: break-all;
            border: 5px solid chocolate;

        }
        
        .main-welcome .card-user h3{
            margin: 10px;
            text-transform: capitalize;
        }
        .main-welcome .card-user p{
            font-size: 12px;
        }
        .main-welcome .card-user button{
            background: orangered;
            color: #fff;
            padding: 15px 80px;
            border-radius: 10px;
            margin-top: 100px;
            cursor: pointer;
        }
        .main-welcome .card-user button:hover{
            background: coral;
        }
        .main-welcome .card-user i{
            font-size: 22px;
            padding: 10px;
            /* margin-bottom: 15px; */
            /* background-color: chocolate; */
            border-radius: 40px;
        }
        .main-data{
            display: table;
            margin-top: 20px;
        }
        .main-data .card{
            width: 100%;
            margin: 50px;
            margin-left: 150px;
            background: #fff;
            text-align: center;
            border-radius: 20px;
            padding: 10px;
            box-shadow: 0 20px 35px black;
            word-break: break-all;
            border: 5px solid chocolate;
        }
        
        .main-data .card h3{
            margin: 10px;
            text-transform: capitalize;
        }
        .main-data .card p{
            font-size: 12px;
        }
        .main-data .card button{
            background: orangered;
            color: #fff;
            padding: 7px 15px;
            border-radius: 10px;
            margin-top: 15px;
            cursor: pointer;
        }
    
        .main-data .card button:hover{
            background: coral;
        }
        .main-data .card i{
            font-size: 22px;
            padding: 10px;
        }
        label{
            display: table;
            padding-left: 80px;
            padding-top: 35px;
            font-weight: 800;
            font-size: 22px;
            text-transform: capitalize;
        }
        .container{
            display: flex;
        }

        .main-data a{
            color: white;
        }
    </style>
</head>
<body>
    <section class="main">
        <div class="main-top">
            <h1>Welcome back,  <?= $_SESSION['username'] ?></h1> 
        </div>
        <div class="container">
        <div class="main-welcome">
            <div class="card-user">
                <i class="fas fa-user"></i>
                <h3>Profile</h3>
                <p>This is you!</p>
                <label for="">Id User: <?= $_SESSION['id_user'] ?></label>
                <br>
                <label for="">Username: <?= $_SESSION['username'] ?></label>
                <br>
                <label for="">Nama Outlet: <?= $outletnya['nama'] ?></label>
                <br>
                <label for="">Your role: <?= $_SESSION['role'] ?></label>   

            </div>
        </div>
        <?php
$ambilStatus = mysqli_query($connection, "SELECT COUNT(*) AS jumlah_status FROM tb_transaksi WHERE status='baru'");
$rowStatus = mysqli_fetch_assoc($ambilStatus);
$statusCount = $rowStatus['jumlah_status'] ?? 0;
    // Query to count the number of outlets
$queryOutletCount = "SELECT COUNT(*) AS outlet_count FROM tb_outlet";
$resultOutletCount = mysqli_query($connection, $queryOutletCount);
$rowOutletCount = mysqli_fetch_assoc($resultOutletCount);
$outletCount = $rowOutletCount['outlet_count'] ?? 0;

// Query to count the number of members
$queryMemberCount = "SELECT COUNT(*) AS member_count FROM tb_member";
$resultMemberCount = mysqli_query($connection, $queryMemberCount);
$rowMemberCount = mysqli_fetch_assoc($resultMemberCount);
$memberCount = $rowMemberCount['member_count'] ?? 0;

    if ($_SESSION['role'] == 'admin') {
    ?>       
    <div class="main-data">
    <div class="card">
        <i class="fas fa-shopping-basket"></i>
        <h3>Jumlah Status baru</h3>
        <p>Berikut adalah jumlahnya: <?= $statusCount ?></p>
        <button><a href="dashboard.php?page=laporan&status=baru">Cek status</a></button>
    </div>
    <div class="card">
        <i class="fas fa-shop"></i>
        <h3>Jumlah Outlet</h3>
        <p>Berikut adalah jumlahnya: <?= $outletCount ?></p>
        <button><a href="dashboard.php?page=outlet">Cek Outlet</a></button>
    </div>
    <div class="card">
        <i class="fas fa-person"></i>
        <h3>Jumlah member</h3>
        <p>Berikut adalah jumlahnya: <?= $memberCount ?></p>
        <button><a href="dashboard.php?page=member">Cek Member</a></button>
    </div>
    </div>
    <?php
} elseif ($_SESSION['role'] == 'kasir') {
    ?>
    <!-- Card for Kasir -->
    <div class="main-data">
    <div class="card">
        <i class="fas fa-person"></i>
        <h3>Jumlah member</h3>
        <p>Berikut adalah jumlahnya: <?= $memberCount ?></p>
        <button><a href="dashboard.php?page=member">Cek Member</a></button>
    </div>
    <div class="card">
        <i class="fas fa-shopping-basket"></i>
        <h3>Jumlah Status baru</h3>
        <p>Berikut adalah jumlahnya: <?= $statusCount ?></p>
        <button><a href="dashboard.php?page=laporan&status=baru">Cek status</a></button>
    </div>
    </div>
    <?php
} else {
    ?>
    <div class="main-data">
    <div class="card">
        <i class="fas fa-shopping-basket"></i>
        <h3>Jumlah Status baru</h3>
        <p>Berikut adalah jumlahnya: <?= $statusCount ?></p>
        <button><a href="dashboard.php?page=laporan&status=baru">Cek status</a></button>
    </div>
    </div>
    <?php
}
?>
        </div>
    </section>
</body>
</html>