<?php
session_start();
include "../connection.php";

$id_to_delete = $_GET['id'];

// Mengambil ID pengguna yang sedang masuk dari sesi
$id_user_in_session = $_SESSION['id_user'];

// Pemeriksaan keamanan: Apakah ID pengguna yang akan dihapus sama dengan ID pengguna yang sedang masuk dalam sesi?
if ($id_to_delete == $id_user_in_session) {
    echo "<script>alert('Tidak diizinkan menghapus pengguna yang sedang masuk dalam sesi.'); window.location.href='../dashboard.php?page=user';</script>";
} else {
    // Jika bukan pengguna yang sedang masuk, lakukan penghapusan
    $query_delete = mysqli_query($connection, "DELETE FROM tb_user WHERE id=$id_to_delete");

    if (!$query_delete) {
        echo "Gagal Menghapus data User " . mysqli_error($connection);
    } else {
        header('Location:../dashboard.php?page=user');
    }
}
?>
