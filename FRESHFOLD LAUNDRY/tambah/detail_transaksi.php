<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2{
            padding: 10px;
        }
        form input{    
            padding: 6px;
            font-size: 14px;
            border: 1px solid #ccc;
             border-radius: 5px;
        }

        button{
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
             border-radius: 5px;
        }
       
        select{
        width: 50%;
        padding: 6px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        }

        .borderpembayaran td{
            border-bottom: 1px solid #dddddd;   
            padding: 10px 10px;
        }
    </style>
</head>
<body>
<?php
if (@$_GET['idtransaksi']){
  $idtransaksi = $_GET['idtransaksi'];
 $_SESSION['idtransaksi'] = $idtransaksi;
}elseif (@$_SESSION['idtransaksi']){
  $idtransaksi = $_SESSION['idtransaksi'];
}

$data_transaksi = mysqli_fetch_row(mysqli_query($connection, "SELECT * FROM tb_transaksi INNER JOIN tb_member ON tb_transaksi. id_member=tb_member. id INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet. id INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id WHERE tb_transaksi.id='$idtransaksi'"));

if (@$_POST['pilih_paket']){
$qty = $_POST['qty'];
$nama_paket = $_POST['nama_paket'];
$row_paket = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM tb_paket WHERE nama_paket='$nama_paket'"));
$harga_paket = $row_paket['harga'];
$total_harga = $qty * $harga_paket;
$id_paket = $row_paket['id'];
$keterangan = $_POST['keterangan'];
mysqli_query($connection, "INSERT INTO tb_detail_transaksi VALUES(NULL, '$idtransaksi', '$id_paket', '$qty', '$keterangan', '$harga_paket', '$total_harga')");
echo "<script>window.location.href=window.location.href</script>";
}

if (@$_POST['bayar_sekarang']){
    date_default_timezone_set('Asia/Makassar');
    $tgl_bayar = date("Y-m-d H:i:s");

    mysqli_query($connection, "UPDATE tb_transaksi SET tgl_bayar='$tgl_bayar' WHERE id='$idtransaksi'");

    mysqli_query($connection, "UPDATE tb_transaksi SET dibayar='dibayar' WHERE id='$idtransaksi'");
    echo "<script>window.location.href=window.location.href</script>";
}

if ($data_transaksi['11']=='belum_dibayar'){
$pembayaran = "Belum Bayar";
$warna = "#ffbc00";
}else{
$pembayaran ="Lunas";
$warna = "#60dd60";
}

if (@$_POST['tombol_biaya_tambahan']){
$biaya_tambahan = $_POST['biaya_tambahan'];
mysqli_query($connection, "UPDATE tb_transaksi SET biaya_tambahan='$biaya_tambahan' WHERE id='$idtransaksi'");
echo "<script>window.location.href=window.location.href</script>";
}


?>

<br>


<center>
    <div class="background-pembayaran">
    <h2><?=$pembayaran?></h2>


    <!-- tabel atas -->

    <table class="borderpembayaran" border="1" cellspacing="0" style="width: 50%; border: 5px solid <?=$warna?>">

        <td>Kode Invoice</td>
        <td><?=$data_transaksi['2'];?></td>
        </tr>
        <tr>
            <td>Nama Pelanggan</td>
            <td><?=$data_transaksi['14'];?></td>
        </tr>
        <tr>
            <td>No Telp</td>
            <td><?=$data_transaksi['17'];?></td>
        </tr>
        <tr>
            <td>Alamat Pelanggan</td>
            <td><?=$data_transaksi['15'];?></td>
        </tr>
        <tr>
            <td>Nama Kasir</td>
            <td><?=$data_transaksi['23'];?></td>

        </tr>
        <tr>
            <td>Ambil Sebelum</td>
            <td>

                <?php
$data_transaksi['5'];
$pecah_string_tanggal = explode(" ", $data_transaksi['5']);
$pecah_string_hari = explode("-", $pecah_string_tanggal['0']);
$pecah_string_jam = explode(":", $pecah_string_tanggal['1']);

echo "Tanggal : ".$pecah_string_hari['2']."-".$pecah_string_hari['1']."-".$pecah_string_hari['0'];
echo "<br>";
echo "Jam : ".$pecah_string_jam['0'].":".$pecah_string_jam['1']
?>
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select onchange="pilihStatus(this.options[this.selectedIndex].value, <?=$data_transaksi['0']?>)">
                    <option value="baru" <?php if($data_transaksi['10']=='baru'){echo "selected";}?>>
                        Baru
                    </option>
                    <option value="proses" <?php if($data_transaksi['10']=='proses'){echo "selected"; }?>>
                        Proses
                    </option>
                    <option value="selesai" <?php if($data_transaksi['10']=='selesai'){echo "selected"; }?>>
                        Selesai
                    </option>
                    <option value="diambil" <?php if($data_transaksi['10']=='diambil'){echo "selected"; }?>>
                        Sudah Diambil
                    </option>
                </select>
                <script>
                function pilihStatus(value, id) {
                    window.location.href = 'edit/proses_edit_status.php?status=' + value + '&id=' + id;
                }
                </script>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
    <br><br>
    <!-- tabel atas -->


    <!-- input paket-->
    <?php
if ($data_transaksi['11']=='belum_dibayar'){
?>
    <form action="dashboard.php?page=detail_transaksi" method="POST" class="tidak_print">
        <span>Nama Paket</span>
        <input type="text" name="nama_paket" List="nama_paket" autocomplete="off" required>
        <datalist id="nama_paket">
            <?php
            $id_outlet=$data_transaksi['18'];
            $query_paket = mysqli_query($connection, "SELECT nama_paket FROM tb_paket WHERE id_outlet='$id_outlet'");
            while($data_paket = mysqli_fetch_assoc($query_paket)){
            ?>

            <option value="<?=$data_paket ['nama_paket'] ?>"></option>
            <?php
            }
            ?>
        </datalist>
        <span>Qty</span>
        <input type="number" name="qty" required>
        <span>Keterangan</span>
        <input type="text" name="keterangan" autocomplete="off">
        <input type="submit" value="Masukkan Paket" name="pilih_paket">
    </form>
    <?php
}
?>
    <br>
    <!-- input paket -->


    <!-- biaya tambahan -->

    <?php
if ($data_transaksi['11']=='belum_dibayar'){
?>
    <form action="dashboard.php?page=detail_transaksi" method="POST" class="tidak_print">
        <table>
            <tr>
                <td>
                    <input type="number" placeholder="Biaya Tambahan" name="biaya_tambahan">
                    <input type="submit" value="tambah" name="tombol_biaya_tambahan">
                </td>
            </tr>
        </table>
    </form>
    <?php
}
?>
    <br>
    <!-- biaya tambahan -->





    <!-- tabel transaksi -->
    <br>
    <table class="borderpembayaran" border="1" cellspacing="0" style="width: 50%;">
        <thead>
            <tr style=" font-weight:700">
                <td>Nama Paket</td>
                <td align="right">Keterangan</td>
                <td align="center">Qty</td>
                <td>Harga</td>
                <td align="right">Total Harga</td>
            </tr>
        </thead>
        <tbody>
            <?php
$result_detail = mysqli_query($connection, "SELECT * FROM tb_detail_transaksi WHERE id_transaksi='$idtransaksi'");
while ($detail = mysqli_fetch_assoc($result_detail)) {
?>
            <tr>
                <td>
                    <?php
$idpaket= $detail['id_paket'];
$paket = mysqli_fetch_assoc(mysqli_query($connection, "SELECT nama_paket, jenis, harga FROM tb_paket WHERE id='$idpaket'"));
echo $paket ['nama_paket'];
echo "<br>";
echo $paket['jenis'];
?>
                </td>
                <td align="right"><?=$detail['keterangan']?></td>
                <td align="center"><?=$detail['qty']?></td>
                <td><?=number_format($detail['harga_paket'], 0, ',', '.')?></td>
                <td align="right" style="font-weight:700">
                    Rp.<?=number_format($detail['total_harga'], 0, ',', '.')?></td>
                <?php
if ($data_transaksi['11']=='belum_dibayar'){
?>
                <form action="delete/delete_paket_detail.php" method="GET">
                    <input type="text" name="id" hidden value="<?=$detail['id']?>">
                    <td><button class="tidak_print" type="submit"><i class="fa-solid fa-x"></i></button>
                    </td>
                </form>
                <?php
}
?>
            </tr>
            <?php
}
?>
            <?php

$grand_total = mysqli_fetch_row(mysqli_query($connection, "SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$idtransaksi'"));
if(!$grand_total['0']=='0'){

?>
            <tr>
                <td colspan="4" style="font-weight: 700" align="right">Pajak
                </td>
                <td align="right" style="font-weight:700">
                    <?php
echo "0,75%";
echo "<br>";
$pajak = $grand_total['0'] * $data_transaksi['9'];
echo "Rp.".number_format($pajak, 0, ',', '.');
?>
                </td>
            </tr>
            <?php
if ($data_transaksi['7']!='0'){
?>
            <tr>
                <td colspan="4" style="font-weight:700" align="right">Biaya Tambahan
                </td>
                <td align="right" style="font-weight:700">
                    <?= "Rp.".number_format($data_transaksi['7'], 0, ',', '.');?>
                </td>
            </tr>
            <?php
}
if ($data_transaksi['8'] !='0'){
?>
            <tr>
                <td colspan="4" style="font-weight: 700" align="right">Diskon
                </td>
                <td align="right" style="font-weight:700">
                    <?php
echo "10%";
echo "<br>";
$diskon = $grand_total['0'] * $data_transaksi['8'];
echo "Rp.".number_format($diskon, 0, ',', '.');
?>
                </td>
            </tr>
            <?php
}else{
$diskon = 0;
}
?>
            <tr>
                <td colspan="4" style="font-weight:700" align="right">Total Keseluruhan
                </td>
                <td align="right" style="font-weight:700">
                    <?php
$total_keseluruhan = ($grand_total['0']+$data_transaksi['7']+$pajak)-$diskon;
echo "Rp.".number_format($total_keseluruhan, 0, ',', '.');
?>
                </td>

            </tr>
            <?php
}
?>
        </tbody>
    </table><br>

    <!-- tabel transaksi -->

    <!-- tombol bayar sekarang -->
     <!-- tombol bayar sekarang -->
    <form action="dashboard.php?page=detail_transaksi" method="POST">
        <table>
            <tr>
                <td>
                    <a onclick="window.print()" type="submit" class="tidak_print" name="cetak">Cetak Nota</a>
                </td>
                <td style="padding-left: 60px;">
                    <input type="submit" <?php if($data_transaksi['11']=='dibayar') echo "hidden"; ?>
                         class="tidak_print" value="Bayar Sekarang?" name="bayar_sekarang"
                        onclick="return confirm('apakah mau bayar sekarang?')">
                </td>
            </tr>
        </table>
    </form>

    <!-- tombol bayar sekarang -->
</center>
</body>
</html>