<?php
include '../koneksi.php';
session_start();
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Axollina Hotel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-collapse layout-top-nav layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark" style="background-color:#1E1E23;">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <img src="../assets/gambar/logohtel.jpg" alt="Axollina Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="pesanan.php" class="nav-link">Pesanan</a>
                        </li>
                    </ul>
                    <?php 
                if (empty($_SESSION['username']) AND empty($_SESSION['password'])){ ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link topnav-right">Logout</a>
                        </li>
                    </ul>
                    <?php } else { ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="" class="nav-link"><?php echo $_SESSION['username']?></a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link topnav-right">Logout</a>
                        </li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <br /><br />
        <br /><br />
        <!-- Content Wrapper. Contains page content -->

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="font-family:'Old Standard TT', serif;">Checkout</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>
                <br><br>
                <div class="container">
                    <div class="col-md-12">
                        <div class="card" style="background-color:#DEDEDA; vertical-align:middle;">
                            <div class="card-body">

                                <br /><br>
                                <?php
                                include '../koneksi.php';
                                $id_pesanan = $_GET['id_pesanan'];
                                $data = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_pesanan='$id_pesanan'");
                                while ($d = mysqli_fetch_array($data)) {
                                    ?>

                                <form action="proses_checkout.php" method="post">
                                    <div class="form-group">
                                        <label>Tanggal Check-in</label>
                                        <input type="text" name="id_pesanan" value="<?php echo $d['id_pesanan']; ?>"
                                            class="form-control" hidden>
                                        <input type="date" name="cek_in" value="<?php echo $d['cek_in']; ?>"
                                            class="form-control" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Check-out</label>
                                        <input type="date" name="cek_out" value="<?php echo $d['cek_out']; ?>"
                                            class="form-control" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Kamar</label>
                                        <input type="text" name="qty" class="form-control"
                                            placeholder="Jumlah Kamar" value="<?php echo $d['jml_kamar']; ?>" required
                                            readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Pemesan</label>
                                        <input type="text" name="nama_pemesan" class="form-control"
                                            placeholder="Masukkan Nama Pemesan"
                                            value="<?php echo $d['nama_pemesan']; ?>" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Pemesan</label>
                                        <input type="text" name="email_pemesan" class="form-control"
                                            placeholder="Masukan Email Pemesan"
                                            value="<?php echo $d['email_pemesan']; ?>" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Handphone</label>
                                        <input type="text" name="hp_pemesan" class="form-control"
                                            placeholder="Masukan No. Handphone" value="<?php echo $d['hp_pemesan']; ?>"
                                            required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Tamu</label>
                                        <input type="text" name="nama_tamu" class="form-control"
                                            placeholder="Masukan Nama Tamu" value="<?php echo $d['nama_tamu']; ?>"
                                            required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipe Kamar</label>
                                        <input type="hidden" name="id_pesanan" value="<?php echo $d['id_pesanan']; ?>">
                                        <select name="id_kamar" class="form-control" readonly>
                                            <option value = "">--- Pilih Kamar ---</option>
                                            <?php
                                            $kamar = mysqli_query($koneksi, "SELECT * FROM kamar");
                                            while ($a = mysqli_fetch_array($kamar)) {
                                                if ($a['id_kamar'] == $d['id_kamar']) { ?>
                                            <option value="<?php echo $a['id_kamar']; ?>" selected>
                                                <?php echo $a['no_kamar']; ?></option>;
                                            <?php }else{?>
                                            <option value="<?php echo $a['id_kamar']; ?>">
                                                <?php echo $a['no_kamar']; ?></option>;
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary" name="tambahkamarcheckout">Checkout</button>
                            </div>
                        </div>
                        </form>
                            <?php } ?>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>




    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <br>
    <footer class="main-footer">
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>

</body>

</html>