<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'function.php';

$identities = query("SELECT * FROM identities");

if(isset($_POST["search"])){
    $identities = searchIdentities($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Website Identitas</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        h2 {
            margin-top: 40px;
            color: #666;
        }

        .form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            margin-right: 10px;
            padding: 5px;
            width: 200px;
        }

        button {
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Website Identitas</h1>
    <a href="login.php" style="color:aqua;">Klik sini untuk login</a>

    <form method="POST" class="form">
        <h2>Tambah Identitas</h2>
        <label for="name">Nama:</label>
        <input type="text" name="name" required>
        <label for="age">Usia:</label>
        <input type="text" name="age" required>
        <label for="address">Alamat:</label>
        <input type="text" name="address" required>
        <button type="submit" name="add">Tambah</button>
    </form>
    

    <form method="POST" class="form">
        <h2>Cari Identitas</h2>
        <label for="keyword">Kata Kunci:</label>
        <input type="text" name="keyword" required>
        <button type="submit" name="search">Cari</button>
    </form>

    <h2>Daftar Identitas</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Usia</th>
            <th>Alamat</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($identities as $identitys) { ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?php echo $identitys['name']; ?></td>
                <td><?php echo $identitys['age']; ?></td>
                <td><?php echo $identitys['address']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $identitys["id"]; ?>">Edit</a> 
                </td>
                <td>
                    <a href="hapus.php?id=<?php echo $identitys["id"]; ?>" 
                    onclick="return confirm('yakin?');">hapus</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php } ?>
    </table>

    
    <a href="logout.php" style="color:red;">Klik disni untuk logout</a>
</body>
</html>
