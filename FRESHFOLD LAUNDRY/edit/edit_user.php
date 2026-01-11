<?php
include "connection.php";
$id = $_GET['id'];

$query = mysqli_query($connection, "SELECT * FROM tb_user WHERE id='$id'");
$row = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Outlet</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f0f0f0;
        /* Background color for the entire page */
    }

    h1 {
        margin-bottom: 20px;
    }

    #all {
        padding-left: 200px;
        width: 95%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #title {
        color: chocolate;
        /* Blue as the primary color */
    }

    #form {
        width: 50%;
        padding: 20px;
        border-radius: 10px;
        background-color: #ffffff;
        /* White background */
        box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2), -4px -4px 8px rgba(255, 255, 255, 0.5);
        /* Neumorphism shadow */
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-family: 'Poppins';
        font-weight: bold;
        color: chocolate;
        /* Blue as the label color */
    }

    input[type="text"],
    input[type="number"],
    select,
    textarea {
        width: 95%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        background-color: #f0f0f0;
        /* Light gray background for input fields */
    }

    textarea {
        resize: vertical;
    }

    input[type="submit"] {
        background-color: chocolate;
        /* Blue as the submit button background color */
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
        /* Smooth transition */
    }

    input[type="submit"]:hover {
        background-color: coral;
        /* Darker blue on hover */
    }
    </style>
</head>

<body>
    <div id="all">
        <h1 id="title">Edit Karyawan</h1>
        <form action="edit/proses_edit_user.php" method="post" id="form">
            <input type="text" hidden id="" name="id" value="<?=$row['id']?>">

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?=$row['nama']?>">

            <label for="username">username</label>
            <input type="text" id="username" name="username" value="<?=$row['username']?>">

            <label class="nama_outlet">Nama Outlet</label>
                <select name="id_outlet" id="">
                    <?php
                    $query = mysqli_query($connection, "SELECT * FROM tb_outlet");
                    while ($hasil = mysqli_fetch_assoc($query)) {

                    ?>
                        <option value="<?= $hasil['id']; ?>"><?= $hasil['nama']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            <label class="nama_outlet">Role</label>
            <select name="role">
                    <option value="admin" <?php if ($row['role'] == 'admin') {
                                                echo "selected";
                                            } ?>>Admin</option>
                    <option value="kasir" <?php if ($row['role'] == 'kasir') {
                                                echo "selected";
                                            } ?>>kasir</option>
                    <option value="owner" <?php if ($row['role'] == 'owner') {
                                                echo "selected";
                                            } ?>>owner</option>
                </select>

            <label for="password">password</label>
                <input type="text" id="password" name="password" required>

            <center><input type="submit" value="Simpan Data User"></center>
        </form>
    </div>
</body>

</html>