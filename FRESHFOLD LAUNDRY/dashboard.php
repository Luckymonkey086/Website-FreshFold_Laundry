<?php
session_start();
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500&family=Poppins:wght@500&display=swap');


        @media print {
        .tidak_print {
            display: none !important;
        }
    }

        *{
            margin: 0;
            padding: 0;
            outline: none;
            border: none;
            text-decoration: none;
            box-sizing: border-box;
            font-family: 'Oswald', sans-serif;
            font-family: 'Poppins', sans-serif;
        }
        
        body{
            background: whitesmoke;
        }

        nav{
            z-index: 1000;
            position: fixed;
            top: 0;
            bottom: 0;
            height: 100%;
            left: 0;
            background: #fff;
            width: 90px;
            overflow: hidden;
            transition: width 0.2s linear;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
        }
        .logo{
            text-align: center;
            display: flex;
            transition: all 0.5s ease;
            margin: 10px 0 0 10px;
            width: 300px;
            padding: 10px;
        }

        .logo img{
            width: 45px;
            height: 45px;
            border-radius: 30%;
            background-color: chocolate;
        }

        .logo span{
            font-weight: bold;
            padding-left: 8px;
            font-size: 17px;
            text-transform: capitalize;
            
        }

        .dashboard_a{
            position: relative;
            color: rgb(85, 83, 83);
            font-size: 14px;
            display: table;
            width: 300px;
            padding: 10px;
        }

        .fas{
            position: relative;
            width: 70px;
            height: 40px;
            top: 14px;
            font-size: 20px;
            text-align: center;
        }

        .nav-item{
            position: relative;
            top: 12px;
            margin-left: 10px;
            color: black;
        }

        .dashboard_a:hover {
    background-color: #eee;
        }

        nav:hover{
            width: 280px;
            transition: all 0.5s ease;
        }

        .logout{
            position: absolute;
            bottom: 0;
            width: 300px;
            padding: 10px;
        }
        .text-color{
            color: coral;
        }
    </style>
</head>
<body>
     <nav class="tidak_print">
        <ul>
        <?php
      if(@$_SESSION['role']=='admin'){
      ?>

            <li>
                <a href="" class="logo">
                    <img src="images/logo.png" alt="">
                    <span class="nav-item"> <span class="text-color">FreshFold</span> laundry</span>
                </a>
            </li>
            <li><a class= "dashboard_a"href="dashboard.php?page=home">
                <i class="fas fa-home"></i>
                <span class="nav-item">Home</span>
            </a></li>
            <li><a class= "dashboard_a"href="dashboard.php?page=outlet">
                <i class="fas fa-shop"></i>
                <span class="nav-item">Outlet</span>
            </a></li>
            <li><a class= "dashboard_a"href="dashboard.php?page=paket">
                <i class="fas fa-box"></i>
                <span class="nav-item">Paket</span>
            </a></li>
            <li><a class= "dashboard_a" href="dashboard.php?page=member">
                <i class="fas fa-user"></i>
                <span class="nav-item">registerisasi pelanggan</span>
            </a></li>
            <li><a class= "dashboard_a" href="dashboard.php?page=user">
                <i class="fas fa-suitcase"></i>
                <span class="nav-item">Karyawan</span>
            </a></li>
            <li><a class= "dashboard_a"href="dashboard.php?page=tambah_transaksi">
                <i class="fas fa-money-bill"></i>
                <span class="nav-item">Entri Transaksi</span>
            </a></li>
            <li><a class= "dashboard_a"href="dashboard.php?page=laporan">
                <i class="fas fa-clipboard"></i>
                <span class="nav-item">Laporan</span>
            </a></li>
            <li><a href="logout.php" class="logout">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item">Log out</span>
            </a></li>
                  <!-- menu kasir-->
                  <?php
      }elseif(@$_SESSION['role']=='kasir'){
      ?>
           <li>
                <a href="" class="logo">
                    <img src="images/logo.png" alt="">
                    <span class="nav-item"> <span class="text-color">FreshFold</span> laundry</span>
                </a>
            </li>
            <li><a class= "dashboard_a"href="dashboard.php?page=home">
                <i class="fas fa-home"></i>
                <span class="nav-item">Home</span>
            </a></li>
       <li><a class= "dashboard_a"href="dashboard.php?page=member">
                <i class="fas fa-user"></i>
                <span class="nav-item">registerisasi pelanggan</span>
            </a></li>
            <li><a class= "dashboard_a" href="dashboard.php?page=tambah_transaksi">
                <i class="fas fa-money-bill"></i>
                <span class="nav-item">Entri Transaksi</span>
            </a></li>
            <li><a class= "dashboard_a" href="dashboard.php?page=laporan">
                <i class="fas fa-clipboard"></i>
                <span class="nav-item">Laporan</span>
            </a></li>
            <li><a href="logout.php" class="logout">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item">Log out</span>
            </a></li>
            <?php
      }elseif(@$_SESSION['role']=='owner'){

      ?>
           <li>
                <a href="" class="logo">
                    <img src="images/logo.png" alt="">
                    <span class="nav-item"> <span class="text-color">FreshFold</span> laundry</span>
                </a>
            </li>
            <li><a class= "dashboard_a"href="dashboard.php?page=home">
                <i class="fas fa-home"></i>
                <span class="nav-item">Home</span>
            </a></li>
              <li><a class= "dashboard_a" href="dashboard.php?page=laporan">
                <i class="fas fa-clipboard"></i>
                <span class="nav-item">Laporan</span>
            </a></li>
            <li><a href="logout.php" class="logout">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item">Log out</span>
            </a></li>
            <?php
      }
      else{
        echo "<script>alert('Silahkan login terlebih dahulu');window.location.href='login.php'</script>";
      }
      ?>
        </ul>
     </nav>

     <!-- awal konten-->
    <?php
   switch(@$_GET['page']){
    case'outlet':
        include "view/view_outlet.php";
    break;
    case 'tambah_outlet':
        include_once "tambah/tambah_outlet.php";
    break;
    case 'edit_outlet':
        include_once "edit/edit_outlet.php";
    break;


    case 'member';
        include_once "view/view_member.php";
    break;
    case 'tambah_member':
        include_once "tambah/tambah_member.php";
    break;
    case 'edit_member':
        include_once "edit/edit_member.php";
    break;

    case 'user';
        include_once "view/view_user.php";
    break;
    case 'edit_user';
    include_once "edit/edit_user.php";
    break;
    case 'tambah_user':
        include_once "tambah/tambah_user.php";
    break;

    
    case 'paket';
        include_once "view/view_paket.php";
    break;
    case 'tambah_paket':
        include_once "tambah/tambah_paket.php";
    break;
    case 'edit_paket':
        include_once "edit/edit_paket.php";
    break;

    case 'tambah_transaksi':
        include_once "tambah/tambah_transaksi.php";
        break;
    case 'laporan':
        include_once "view/view_laporan.php";
        break;
    case 'detail_transaksi':
        include_once('tambah/detail_transaksi.php');
        break;

    default:
        include_once "view/view_home.php";
        break;



   }
?>
</body>
</html>