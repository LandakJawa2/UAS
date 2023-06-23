<?php


require 'function.php';
$id = $_GET["id"];


// if( hapus($id) > 0){
//     echo "
//             <script>
//                 alert('data berhasil dihapus!');
//                 document.location.href = 'hello5.php';
//             </script>
//         ";
//     }else{
//         echo "
//             <script>
//                 alert('data gagal dihapus!');
//                 document.location.href = 'hello5.php';
//             </script>
//             ";
// }

// Memproses form penghapusan identitas
if (deleteIdentity($id)) {
    echo "<script>
            alert('Data identitas berhasil dihapus');
            document.location.href = 'main.php';
            </script>";
} else {
    echo "<script>
            alert('Terjadi kesalahan saat menghapus data identitas');
            document.location.href = 'main.php';
            </script>";
}

?>