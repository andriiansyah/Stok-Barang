<?php 

    session_start();
    require_once("../../function.php");
    // Get id from URL to delete that user
    $id = $_GET['id'];
    
    // Delete user row from table based on given id
    // $result = mysqli_query($conn, "DELETE FROM stok_barang WHERE id_barang=$id");
    // $result_keluar = mysqli_query($conn, "DELETE FROM barang_keluar WHERE id_barang=$id");
    $tampil_keluar = mysqli_query($conn, "SELECT * FROM barang_keluar WHERE id_keluar = $id");
    $ambil_data_keluar = mysqli_fetch_array($tampil_keluar);
    $qty = $ambil_data_keluar['qty'];
    $id_barang = $ambil_data_keluar['id_barang'];

    $tampil_stok = mysqli_query($conn, "SELECT stok FROM stok_barang WHERE id_barang = $id_barang");
    $ambil_data_stok = mysqli_fetch_array($tampil_stok);
    $stok = $ambil_data_stok['stok'];

    $jumlah_stok = $stok + $qty;

    $result_stok = mysqli_query($conn, "UPDATE stok_barang SET stok = '$jumlah_stok' WHERE id_barang = $id_barang");
    $result_keluar = mysqli_query($conn, "DELETE FROM barang_keluar WHERE id_keluar = $id");
    
    // After delete redirect to Home, so that latest user list will be displayed.
    if($result_stok && $result_keluar) {
        header('location:keluar.php');
    } else {
        echo "Gagal";
        header('location:edit_keluar.php');
    }

?>