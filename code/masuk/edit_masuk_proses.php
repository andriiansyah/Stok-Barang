<?php 

    session_start();
    require_once("../../function.php");

    // Menambah barang baru
    $idmasuk = $_POST['idmasuk'];
    $barangnya = $_POST['barangnya'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $id_barang = $_POST['id_barang'];

    // Mereset qty terlebih dahulu di tabel barang_masuk
    $tampil_masuk = mysqli_query($conn, "SELECT * FROM barang_masuk WHERE id_masuk = $idmasuk");
    $ambil_data_masuk = mysqli_fetch_array($tampil_masuk);
    $qty_masuk = $ambil_data_masuk['qty'];

    $tampil_stok = mysqli_query($conn, "SELECT * FROM stok_barang WHERE id_barang = $id_barang");
    $ambil_data_stok = mysqli_fetch_array($tampil_stok);
    $qty_stok = $ambil_data_stok['stok'];

    // Hitung reset stok
    $stok_reset = $qty_stok - $qty_masuk;


    // echo $qty_masuk."<br>";
    // echo $qty_stok."<br>";
    // echo $stok_reset;

    // Query update reset di tabel stok
    $reset_update_stok = mysqli_query($conn, "UPDATE stok_barang SET stok = '$stok_reset' WHERE id_barang = $id_barang");

    // Query update masuk
    $update_masuk = mysqli_query($conn, "UPDATE barang_masuk SET id_barang = '$barangnya', tanggal = '$tanggal', keterangan = '$keterangan', qty = '$qty' WHERE id_masuk = $idmasuk");

    // Query update menjumlahkan data stok baru di update di tabel stok_barang
    $tampil_stok = mysqli_query($conn, "SELECT * FROM stok_barang WHERE id_barang = $barangnya");
    $ambil_data_stok = mysqli_fetch_array($tampil_stok);
    $qty_stok = $ambil_data_stok['stok'];
    $jumlah = $qty_stok + $qty;
    $hasil_akhir_stok = mysqli_query($conn, "UPDATE stok_barang SET stok = '$jumlah' WHERE id_barang = $barangnya");

    if($reset_update_stok && $update_masuk && $hasil_akhir_stok) {
        header('location:masuk.php');
    } else {
        echo "Gagal";
        header('location:edit_masuk.php');
    }

?>