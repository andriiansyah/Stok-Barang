<?php 
    require_once("../../function.php");
    require_once("../../cek.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stok Barang</title>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="stok.php">Andri Stok</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="../stokbarang/stok.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stok Barang
                            </a>

                            <a class="nav-link" href="../masuk/masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>

                            <a class="nav-link" href="../keluar/keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>

                            <a class="nav-link" href="../../logout.php">
                                LogOut
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Stok Barang Keluar</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Edit Data Barang Keluar</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php 
                                    $id_keluar = $_GET['id'];

                                    $result = mysqli_query($conn, "SELECT * FROM barang_keluar WHERE id_keluar = $id_keluar");
                                    while($data = mysqli_fetch_array($result))
                                    {
                                        $id_barang = $data['id_barang'];
                                        $tanggal = $data['tanggal'];
                                        $penerima = $data['penerima'];
                                        $qty = $data['qty'];
                                    }
                                ?>
                                    <form method="POST" action="edit_keluar_proses.php">
                                        <div class="form-group">
                                            <!-- Id Keluar -->
                                            <input type="text" class="form-control" name="id_keluar" value="<?= $id_keluar; ?>">
                                            <!-- Id Barang -->
                                            <input type="text" class="form-control" name="id_barang2" value="<?= $id_barang; ?>">

                                            <label for="namabarang">Nama Barang</label>
                                            <select name="id_barang" class="form-control">
                                                <?php 
                                                    $ambilsemuadatanya = mysqli_query($conn, "SELECT * FROM stok_barang");
                                                    while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                        $namabarangnya = $fetcharray['nama_barang'];
                                                        $idbarangnya = $fetcharray['id_barang'];
                                                ?>

                                                <option value="<?= $idbarangnya; ?>" <?php if($idbarangnya == $id_barang){ echo "selected"; } ?>><?= $namabarangnya; ?></option>

                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="text" class="form-control" name="tanggal" value="<?= $tanggal; ?>" placeholder="Masukan tanggal" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Penerima</label>
                                            <input type="text" class="form-control" name="penerima" value="<?= $penerima; ?>" placeholder="Masukan penerimanya" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="number" class="form-control" name="qty" value="<?= $qty; ?>" placeholder="Masukan quantitynya" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Andriansyah</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/demo/chart-area-demo.js"></script>
        <script src="../../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/demo/datatables-demo.js"></script>
    </body>
</html>
