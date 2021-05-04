<?php 

    session_start();
    require_once("../../function.php");
    // Get id from URL to delete that user
    $id = $_GET['id'];
    
    // Delete user row from table based on given id
    $result = mysqli_query($conn, "DELETE FROM stok_barang WHERE id_barang=$id");
    $result_masuk = mysqli_query($conn, "DELETE FROM barang_masuk WHERE id_barang=$id");
    $result_keluar = mysqli_query($conn, "DELETE FROM barang_keluar WHERE id_barang=$id");
    
    // After delete redirect to Home, so that latest user list will be displayed.
    header("Location:stok.php");

?>