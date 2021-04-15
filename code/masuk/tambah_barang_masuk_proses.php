<?php 

    session_start();
    require_once("../../function.php");

    // Menambah barang masuk
    $nama_barang = $_POST['barangnya'];
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stok_barang WHERE id_barang='$nama_barang'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stok'];
    $tambahkanstoksekarangdenganquantity = $stocksekarang+$qty;

    $addtotable = mysqli_query($conn, "INSERT INTO barang_masuk (id_barang, tanggal, keterangan, qty) VALUES('$nama_barang', '$tanggal', '$keterangan', '$qty')");
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok_barang SET stok='$tambahkanstoksekarangdenganquantity' WHERE id_barang='$nama_barang'");
    if($addtotable && $updatestokmasuk) {
        header('location:masuk.php');
    } else {
        echo "Gagal";
        header('location:tambah_barang_masuk.php');
    }

?>