<?php 

    session_start();
    require_once("../../function.php");

    // Menambah barang baru
    $id_keluar = $_POST['id_keluar'];
    $id_barang = $_POST['id_barang'];
    $tanggal = $_POST['tanggal'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $id_barang2 = $_POST['id_barang2'];

    // Mereset qty terlebih dahulu di tabel barang_keluar
    $tampil_keluar = mysqli_query($conn, "SELECT * FROM barang_keluar WHERE id_keluar = $id_keluar");
    $ambil_data_keluar = mysqli_fetch_array($tampil_keluar);
    $qty_keluar = $ambil_data_keluar['qty'];

    $tampil_stok = mysqli_query($conn, "SELECT * FROM stok_barang WHERE id_barang = $id_barang2");
    $ambil_data_stok = mysqli_fetch_array($tampil_stok);
    $qty_stok = $ambil_data_stok['stok'];

    // Hitung reset stok
    $stok_reset = $qty_stok + $qty_keluar;


    // echo $qty_masuk."<br>";
    // echo $qty_stok."<br>";
    // echo $stok_reset;

    // Query update reset di tabel stok
    $reset_update_stok = mysqli_query($conn, "UPDATE stok_barang SET stok = '$stok_reset' WHERE id_barang = $id_barang2");

    // Query update masuk
    $update_keluar = mysqli_query($conn, "UPDATE barang_keluar SET id_barang = '$id_barang', tanggal = '$tanggal', penerima = '$penerima', qty = '$qty' WHERE id_keluar = $id_keluar");

    // Query update menjumlahkan data stok baru di update di tabel stok_barang
    $tampil_stok = mysqli_query($conn, "SELECT * FROM stok_barang WHERE id_barang = $id_barang");
    $ambil_data_stok = mysqli_fetch_array($tampil_stok);
    $qty_stok = $ambil_data_stok['stok'];
    $jumlah = $qty_stok - $qty;
    $hasil_akhir_stok = mysqli_query($conn, "UPDATE stok_barang SET stok = '$jumlah' WHERE id_barang = $id_barang");

    if($reset_update_stok && $update_keluar && $hasil_akhir_stok) {
        header('location:keluar.php');
    } else {
        echo "Gagal";
        header('location:edit_keluar.php');
    }

?>