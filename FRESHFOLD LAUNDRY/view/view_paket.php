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
            word-break: break-all;
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
            <h1>Paket</h1>
            <div class="search">
                <form action="dashboard.php?page=paket" method="get"> 
                    <input type="text" placeholder="Search" name="keyword"></input>
                    <input type="hidden" name="page" value="paket">
                    <button class="btn_search" type="submit" value=""><i class="fas fa-search"></i></button>
            </form>
            <button class="add_new"><a href="dashboard.php?page=tambah_paket">+ tambah paket baru</a></button>
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Outlet</th>
                    <th>Jenis Paket</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$NO = 1;
$sql = "SELECT 
            tb_paket.id AS id,
            tb_paket.nama_paket AS nama_paket,
            tb_paket.jenis AS jenis,
            tb_outlet.nama AS nama_outlet,
            tb_paket.id_outlet AS id_outlet_paket,
            tb_paket.harga AS harga
        FROM tb_paket
        JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id";

$query = mysqli_query($connection, $sql);

if (isset($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($connection, $_GET['keyword']);
    $query = mysqli_query($connection, "SELECT *, tb_paket.id_outlet AS id_outlet_paket
                                        FROM tb_paket 
                                        JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id 
                                        WHERE nama_paket LIKE '%$keyword%'");
}
if (isset($_POST['delete_paket'])) {
    $id_paket = $_POST['id']; // Menggunakan $_POST untuk memperoleh nilai dari form
    // Pastikan $id_paket memiliki nilai yang valid sebelum menghapus data
    if (!empty($id_paket)) {
        $queryDeleteDetail = mysqli_query($koneksi, "DELETE FROM tb_detail_transaksi WHERE Id_Detail = '$id_paket'");
        if (!$queryDeleteDetail) {
            echo "Gagal Delete: " . mysqli_error($koneksi);
        } else {
            echo "<script>location.href='" . $_SERVER['REQUEST_URI'] . "';</script>";
        }
    } else {
        echo "ID paket tidak valid.";
    }
}
while ($baris = mysqli_fetch_assoc($query)) {
    $id_outlet_paket = $baris['id_outlet_paket'];
    $query_outlet = mysqli_query($connection, "SELECT nama FROM tb_outlet WHERE id = '$id_outlet_paket'");
    $outletnya = mysqli_fetch_assoc($query_outlet);
?>
    <tr>
        <td><?= $NO++; ?></td>
        <td><?= $outletnya['nama']; ?></td>
        <td><?= $baris['jenis']; ?></td>
        <td><?= $baris['nama_paket']; ?></td>
        <td><?= $baris['harga']; ?></td>
        <td>
            <button><a href="dashboard.php?page=edit_paket&id=<?= $baris['id']; ?>"><i class="fa-solid fa-pen-to-square "></i></a></button>
        </td>
           <?php
                    $id = $baris['id'];
                    $hide_delete = mysqli_fetch_row(mysqli_query($connection, "SELECT COUNT(*) as total FROM tb_paket INNER JOIN tb_transaksi ON tb_transaksi.id_outlet = tb_transaksi.id WHERE tb_paket.id='$id'"));
                    if ($hide_delete[0] == '0') {
                        ?>
                     <td><button><a  onclick="return confirm('apakah ingin menghapus data')" href="delete/delete_paket.php?id=<?=$id['id']?>"><i class="fa-solid fa-trash"></i></a></button></td>
                     <?php
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