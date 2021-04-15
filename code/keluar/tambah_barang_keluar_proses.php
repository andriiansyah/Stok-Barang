<?php 

    session_start();
    require_once("../../function.php");

    // Menambah barang keluar
    $nama_barang = $_POST['barangnya'];
    $tanggal = $_POST['tanggal'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stok_barang WHERE id_barang='$nama_barang'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stok'];
    $tambahkanstoksekarangdenganquantity = $stocksekarang-$qty;

    $addtotable = mysqli_query($conn, "INSERT INTO barang_keluar (id_barang, tanggal, penerima, qty) VALUES('$nama_barang', '$tanggal', '$penerima', '$qty')");
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok_barang SET stok='$tambahkanstoksekarangdenganquantity' WHERE id_barang='$nama_barang'");
    if($addtotable && $updatestokmasuk) {
        header('location:keluar.php');
    } else {
        echo "Gagal";
        header('location:tambah_barang_keluar.php');
    }

?>