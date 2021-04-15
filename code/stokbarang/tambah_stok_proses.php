<?php 

    session_start();
    require_once("../../function.php");

    // Menambah barang baru
    $nama_barang = $_POST['namabarang'];
    $jenis = $_POST['jenis'];
    $stok = $_POST['stok'];

    $addtotable = mysqli_query($conn, "INSERT INTO stok_barang (nama_barang, jenis, stok) VALUES('$nama_barang', '$jenis', '$stok')");
    if($addtotable) {
        header('location:stok.php');
    } else {
        echo "Gagal";
        header('location:tambah_stok.php');
    }

?>