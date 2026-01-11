<!DOCTYPE html>
<html>

<head>
    <title>Tambah Member </title>
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
        <h1 id="title">Tambah Member</h1>
        <form action="tambah/proses_tambah_member.php" method="post" id="form">
            <!-- <label for="id_obat">ID Obat:</label>
            <input type="text" id="id_obat" name="id_obat" required> -->

            <label for="nama_Outlet">Nama</label>
            <input type="text" id="nama_outlet" name="nama">

            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat">

            <label for="">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="" required>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select>

            <label for="telp">Telp</label>
            <input type="text" id="telp" name="telp">

            <center><input type="submit" value="Simpan Data member"></center>
        </form>
    </div>
</body>

</html>