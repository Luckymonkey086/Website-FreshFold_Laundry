<?php
    include "../connection.php";
    session_start();
    $tgl_awal = $_POST['masukkan_tgl_awal'];
    $tgl_akhir = $_POST['masukkan_tgl_akhir'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>

@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500&family=Poppins:wght@500&display=swap');

    .outlet{
        background-color: chocolate;
    }

    @media print {
        .outlet{
            background-color: chocolate !important;
            -webkit-print-color-adjust: exact;
        }
    }
</style>
<body>
    <h2>Laporan Transaksi laundry</h2>
    <h3>Periode : <?=$tgl_awal."sampai".$tgl_akhir;?></h3>

    <!--algoritma mencari data nama paket yang sering dipilih-->

    <?php
if (@$_SESSION['role'] == 'admin' OR @$_SESSION['role'] == 'owner') {
    $query_result = mysqli_query($connection, "SELECT nama_paket, COUNT(nama_paket) AS jumlah_penggunaan
        FROM tb_transaksi INNER JOIN tb_detail_transaksi ON tb_transaksi.id = tb_detail_transaksi.id_transaksi 
        INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id
        WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59'
        GROUP BY nama_paket
        ORDER BY jumlah_penggunaan DESC");
} else {
    $id_outlet = $_SESSION['$id_outlet'];
    $query_result = mysqli_query($connection, "SELECT nama_paket, COUNT(nama_paket) AS jumlah_penggunaan 
        FROM tb_transaksi INNER JOIN tb_detail_transaksi ON tb_transaksi.id = tb_detail_transaksi.id_transaksi 
        INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id 
        INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id 
        WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' 
        AND dibayar='dibayar' AND tb_outlet.id='$id_outlet'
        GROUP BY nama_paket
        ORDER BY jumlah_penggunaan DESC");
}

if (mysqli_num_rows($query_result) == 0) {
    echo "Tidak ada penjualan.";
} else {
    $nama_paket = mysqli_fetch_assoc($query_result);
    echo "Paket yang sering dipilih pelanggan: <b>".$nama_paket['nama_paket']."</b>";
}
?>


    <hr style="width:100%", size="3", color=black>
    <hr>

    <?php
        if(@$_SESSION['role']=='admin' OR @$_SESSION['role']=='owner'){
            $query_outlet = mysqli_query($connection,"SELECT tb_outlet.id AS id_outlet, tb_outlet.nama AS nama_outlet FROM tb_detail_transaksi
            INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id
            INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' GROUP BY tb_outlet.id");
        }else{
            $id_outlet = $_SESSION['id_outlet'];
            $query_outlet = mysqli_query($connection,"SELECT tb_outlet.id AS id_outlet, tb_outlet.nama AS nama_outlet FROM tb_detail_transaksi
            INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id
            INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet' GROUP BY tb_outlet.id");
        }
    ?>

    <center>

            <table border="1" cellpadding="10" cellspacing="0">
                <?php
                    $total_semua = 0;
                    while($baris_outlet = mysqli_fetch_assoc($query_outlet)){
                        if(@$_SESSION['role']=='admin' OR @$_SESSION['role']=='owner'){
                            $id_outlet = $baris_outlet['id_outlet'];
                            $query = mysqli_query($connection,"SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi
                            INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id
                            INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id
                            INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id
                            INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id
                            INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet' GROUP BY kode_invoice");
                        }else{
                            $query = mysqli_query($connection,"SELECT *, tb_outlet.id AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi
                            INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id
                            INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id
                            INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id
                            INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id
                            INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id='$id_outlet' GROUP BY kode_invoice");
                        }
                ?>
                <tr>
                    <td align="left" class="outlet" colspan="3">Nama outlet:
                        <b><?=$baris_outlet['nama_outlet']?></b>
                    </td>
                </tr>
                <?php
                    $no = 1;
                    while($baris = mysqli_fetch_assoc($query)){    
                ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?="Pelanggan:  ".$baris['nama_member']?></td>

                    <td align="left">
                        <?php
                        $id_transaksi = $baris['id_transaksi'];
                        $query_paket = mysqli_query($connection, "SELECT nama_paket, qty FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'");
                        while($data_paket = mysqli_fetch_assoc($query_paket)){
                            echo $data_paket['nama_paket'];
                            echo "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                            $grand_total = mysqli_fetch_row(mysqli_query($connection,"SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id WHERE id_transaksi='$id_transaksi'"));
                            $pajak = $grand_total['0'] * $baris['pajak'];
                            $diskon = $grand_total['0'] * $baris['diskon'];
                            $total_keseluruhan = ($grand_total ['0'] +$baris ['biaya_tambahan']+$pajak)-$diskon;
                            $tampil_total = number_format($total_keseluruhan, 0, '.', '.');
                            echo "Total Harga  : <b> Rp ".$tampil_total."</b>";
                            $total_semua += $tampil_total;
                        ?>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
                <tr align="right">
                    <td colspan="3"><b>Total Pendapatan</b>
                    <br>
                    <?php echo "Dari tanggal: " . $tgl_awal . "  Sampai " . $tgl_akhir ?>
                    </td>
                    <td>
                        <?php
                            echo "<h2>Rp ".number_format($total_semua, 3, '.', '.')."</h2>";
                            $pajak_semua = $total_semua*0.0075;
                            echo "Pajak : Rp ".number_format($pajak_semua, 3, '.', '.');
                        ?>
                    </td>
                </tr>
            </table>
    </center>
    <script>
        window.print();
    </script>
</body>
</html>