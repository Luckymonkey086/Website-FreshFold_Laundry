<!DOCTYPE html>
<html>

<head>
    <title>Tambah Outlet</title>
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
    input[type="password"],
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
        <h1 id="title">Tambah Karyawan</h1>
        <form action="tambah/proses_tambah_user.php" method="POST" id="form">
           
            <label for="">Nama lengkap</label>
            <input type="text" name="nama"  autocomplete="off" id="" required>

            <label for="">Username</label>
            <input type="text" name="username"  autocomplete="off" id="" required>

            <label for="">Password </label>
            <input type="password" name="password"  autocomplete="off" id="" required>

            <label for="">Konfirmasi Password </label>
                 <input type="password" name="password2"  autocomplete="off" id="" required>

            <label for="">Role :</label>
            <select name="role" id="" class="role">
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
              </select>      
            <label for="">Outlet :</label>
            <select name="id_outlet" id="" class="outlet">
                            <?php
                                include_once "../connection.php";
                                $query = mysqli_query($connection, "SELECT * FROM tb_outlet");
                                while($hasil = mysqli_fetch_assoc($query)){

                            ?>
                            <option value="<?=$hasil['id'];?>"><?=$hasil['nama'];?></option>
                            <?php
                                }
                            ?>
                            
            </select>
            <center><input type="submit" value="Simpan Data Karyawan"></center>
    </div>
</body>

</html>