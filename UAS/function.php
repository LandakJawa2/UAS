<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'uas';
$connection = mysqli_connect($host, $user, $password, $database);
if (!$connection) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

function query($query){
    global $connection;
    // Ambil data dari table mahasiswa/ query data mahasiswa
    $result = mysqli_query($connection, $query);    
    $identitys = [];
    while($identity = mysqli_fetch_assoc($result)){
        $identitys[] = $identity;
    }
    return $identitys;
}

// Fungsi untuk memasukkan data identitas ke dalam database
function insertIdentity($name, $age, $address)
{
    global $connection;
    $name = mysqli_real_escape_string($connection, $name);
    $age = mysqli_real_escape_string($connection, $age);
    $address = mysqli_real_escape_string($connection, $address);

    $query = "INSERT INTO identities (name, age, address) VALUES ('$name', '$age', '$address')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mengedit data identitas dalam database
function editIdentity($id, $name, $age, $address)
{
    global $connection;
    $id = mysqli_real_escape_string($connection, $id);
    $name = mysqli_real_escape_string($connection, $name);
    $age = mysqli_real_escape_string($connection, $age);
    $address = mysqli_real_escape_string($connection, $address);

    $query = "UPDATE identities SET name='$name', age='$age', address='$address' WHERE id='$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk menghapus data identitas dari database
function deleteIdentity($id)
{
    global $connection;
    $id = mysqli_real_escape_string($connection, $id);

    $query = "DELETE FROM identities WHERE id='$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mencari data identitas berdasarkan kata kunci
function searchIdentities($keyword)
{
    $query = "SELECT  * FROM identities
                WHERE
                name LIKE '%$keyword%' OR
                address LIKE '%$keyword%' OR
                age LIKE '%$keyword%' 
                ";
    return query($query);
}


// Fungsi untuk mengurutkan data identitas berdasarkan nama


// Memproses form penambahan identitas
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    if (insertIdentity($name, $age, $address)) {
        echo "<script>alert('Data identitas berhasil ditambahkan');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menambahkan data identitas');</script>";
    }
}


// // Memproses form penghapusan identitas
// if (isset($_POST['delete'])) {
//     $id = $_POST['id'];

//     if (deleteIdentity($id)) {
//         echo "<script>alert('Data identitas berhasil dihapus');</script>";
//     } else {
//         echo "<script>alert('Terjadi kesalahan saat menghapus data identitas');</script>";
//     }
// }

// // Memproses form pencarian identitas
// if (isset($_POST['search'])) {
//     $keyword = $_POST['keyword'];
//     $identities = searchIdentities($keyword);
// }



function registrasi($data){
    global $connection;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($connection, $data["password"]);
    $password2 = mysqli_real_escape_string($connection, $data["password2"]);


    // cek username sudah ada atau belum
   $result = mysqli_query($connection, "SELECT username FROM users WHERE 
                username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username sudah terdaftar') 
                </script>";
    }

    // cek konfirmasi password
    if($password !== $password2){
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
                </script>";
        return false;
    }
    
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    

    // tambahkan user baru ke dalam database
    mysqli_query($connection, "INSERT INTO users values('', '$username'
                , '$password')");

    return mysqli_affected_rows($connection);

}
?>