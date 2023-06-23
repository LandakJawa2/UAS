<?php
require 'function.php';

// amibl data di URl
$id = $_GET["id"];

// Memproses form pengeditan identitas
if (isset($_POST['edit'])) {    
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    if (editIdentity($id, $name, $age, $address)) {
        echo "<script>
                    alert('Data identitas berhasil diubah');
                    document.location.href = 'main.php';
                </script>";
    } else {
        echo "<script>
                    alert('Terjadi kesalahan saat mengubah data identitas');
                    document.location.href = 'main.php';
                </script>";
    }
}

$mhs = query("SELECT * FROM identities WHERE id = $id")[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <title>Edit Profile</title>
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
    <h1>Edit Identitas</h1>

    <form method="POST" class="form">
        <h2>Edit Identitas</h2>        
        <label for="name">Nama:</label>
        <input type="text" name="name" required
        value="<?= $mhs["name"]; ?>">
        <label for="age">Usia:</label>
        <input type="text" name="age" required
        value="<?= $mhs["age"]; ?>">
        <label for="address">Alamat:</label>
        <input type="text" name="address" required
        value="<?= $mhs["address"]; ?>">
        <button type="submit" name="edit">Edit</button>
    </form>

    <!-- <form method="POST" class="form">        
        <h2>Edit Identitas</h2>
        <input type="hidden" name ="id" value="<?= $mhs["id"]; ?>">
        
        <label for="name">Nama:</label>
        <input type="text" name="name" required
        value="<?= $mhs["name"]; ?>">
        <label for="age">Usia:</label>
        <input type="text" name="age" required
        value="<?= $mhs["age"]; ?>">
        <label for="address">Alamat:</label>
        <input type="text" name="address" required
        value="<?= $mhs["address"]; ?>">
        <button type="submit" name="edit">Edit</button>
    </form> -->
</body>
</html>