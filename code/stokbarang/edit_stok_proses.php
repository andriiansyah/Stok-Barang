<?php 

    session_start();
    require_once("../../function.php");

    // Menambah barang baru
    $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $jenis = $_POST['jenis'];
    $stok = $_POST['stok'];

    $edit = mysqli_query($conn, "UPDATE stok_barang SET nama_barang='$namabarang', jenis='$jenis', stok='$stok' WHERE id_barang=$idbarang");
    if($edit) {
        header('location:stok.php');
    } else {
        echo "Gagal";
        header('location:edit_stok.php');
    }

?>