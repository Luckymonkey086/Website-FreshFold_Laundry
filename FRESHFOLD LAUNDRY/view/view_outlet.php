<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
          @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500&family=Poppins:wght@500&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: 'Oswald', sans-serif;
            font-family: 'Poppins', sans-serif;
            /* overflow: hidden; */
        }

        .table{
            width: 100%;
        }

        .table_header{
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            padding: 20px;
            background-color: white;
        }

        button{
            outline: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    

        .add_new{
            margin-left: 80px;
            padding: 10px 20px;
            color: #ffffff;
            background-color: chocolate;
        }

       

        .add_new a{
            color: #dddddd;
        }

        input{
            padding: 10px 20px;
            margin: 0 10px;
            outline: none;
            border: 1px solid chocolate;
            border-radius: 6px;
        }
        
        ::placeholder{
                color: chocolate;
        }

        .table_section{
            padding-left: 260px;
            padding-right: 160px;
            display: flex;
            align-items: start;
            height: 650px;
            /* overflow: auto; */
            
        }

        table{
            width: 100%;
            table-layout: fixed;
            min-width: 1000px;
        }

        thead th{
            position: sticky;
            top: 0;
            background-color: #f6f9fc;
            font-size: 15px;
        }
        th,td{
            border-bottom: 1px solid #dddddd;   
            padding: 10px 20px;
            /* word-break: break-all; */
            text-align: center  ;
        }

        a{
            color: black;
            
        }
        
        .btn_search 
        {
            border-radius: 20px;
            color: #ffffff;
            background-color: chocolate;
            border: none; /* Remove button border */
        }

        .search {
            display: flex;
            align-items: center; /* Align items vertically */
            width: 47%;
        }

        .search form {
            display: flex;
            flex: 1;
        }

        .search input[type="text"] {
            flex: 1;
            border-radius: 20px 0 0 20px;
            margin: 0; /* Remove any default margins */
        }

        .search .btn_search {
            border-radius: 0 20px 20px 0;
            padding: 5px; /* Keep the same padding */
        }
        
    </style>
</head>
<body>
     <div class="table">
        <div class="table_header">
            <h1>Outlet</h1>
            <div class="search">
                <form action="dashboard.php?page=outlet" method="get"> 
                    <input type="text" placeholder="Search" name="keyword">
                    <input type="hidden" name="page" value="outlet">
                    <button class="btn_search" type="submit" value=""><i class="fas fa-search"></i></button>
                </form>
                <button class="add_new"><a href="dashboard.php?page=tambah_outlet">+ tambah outlet baru</a></button>
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                         <th>No </th>
                         <th>Nama Outlet</th>
                         <th>Alamat</th>
                         <th>No Telp</th>
                         <th colspan="2">aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
         $NO = 1;
            $query = mysqli_query($connection, "SELECT * FROM tb_outlet");

            if (isset($_GET['keyword'])){
                $query = mysqli_query($connection, "SELECT * FROM tb_outlet WHERE nama LIKE '%".
                $_GET['keyword']."%'");
            }
                while($baris = mysqli_fetch_assoc($query)){
                    // var_dump($baris);
            ?>
            <tr>
                <td><?= $NO++; ?></td>
                <td><?= $baris['nama']; ?></td>
                <td><?= $baris['alamat']; ?></td>
                <td><?= $baris['tlp']; ?></td>
                <td>
                <button><a href="dashboard.php?page=edit_outlet&id=<?= $baris['id'];?>"><i class="fa-solid fa-pen-to-square "></i></a></button>
                </td>
                <?php
                 $id = $baris['id'];
                 $hide_delete1 = mysqli_fetch_row(mysqli_query($connection, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_user ON tb_outlet.id=tb_user.id_outlet WHERE tb_outlet.id='$id'"));
                 $hide_delete2 = mysqli_fetch_row(mysqli_query($connection, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_paket ON tb_outlet.id=tb_paket.id_outlet WHERE tb_outlet.id='$id'"));
                 $hide_delete3 = mysqli_fetch_row(mysqli_query($connection, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_transaksi ON tb_outlet.id=tb_transaksi.id_outlet WHERE tb_outlet.id='$id'"));

                if($hide_delete1[0]=='0' && $hide_delete2[0]=='0' && $hide_delete3[0]=='0'){
                ?>
                <td>
               
                 <button><a onclick="return confirm('apakah ingin menghapus data')" href="delete/delete_outlet.php?id=<?=$baris['id']?>"><i class="fa-solid fa-trash"></i></a></button>
                </td>
                <?php  
                }else{
                    echo "<td></td>";
                }
                ?>


            </tr>
            <?php
            }
            ?>
                </tbody>
            </table>
        </div>
     </div>
</body>
</html>