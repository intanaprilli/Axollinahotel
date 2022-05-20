<?php
include 'koneksi.php';
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
    <link rel="shortcut icon" type="icon" href="assets/dist/img/r.png">
    <title>Axollina Hotel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">

    <style>
    .content {
        background-image: url("assets/images/bg.jpg");
        background-size: cover;
        background-position: center;
        height: 100%;
    }

    .wrapper {
        background-image: url("assets/images/bg.jpg");
        background-size: cover;
        background-position: center;
        height: 100%;
    }

    p {
        font-family: "Consolas";
        font-size: 20px;
    }
    </style>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                <img src="assets/gambar/logohtel.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="kamar.php" class="nav-link">Kamar</a>
                        </li>
                        <li class="nav-item">
                            <a href="fasilitas.php" class="nav-link">Fasilitas</a>
                        </li>
                    </ul>
                </div>
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
                            <h1 class="m-0" style="font-family:'Old Standard TT', serif;"> Rigii Hotel </h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>
                <br><br>
                <div class="container">
                    <div class="col-md-12">
                        <div class="card" style="background-color:#DEDEDA; vertical-align:middle;">
                            <div class="card-body">


                                <div id="print-area-3" class="print-area">
                                    <?php include 'koneksi.php';

                                        if (isset($_GET['id_pesanan'])) {
                                            $id_pesanan = ($_GET['id_pesanan']);
                                            $query = "SELECT * FROM pesanan WHERE id_pesanan='$id_pesanan'";
                                            $hasil = mysqli_query($koneksi, $query);
                                            if (!$hasil) {
                                                die('Query Error: '.mysqli_error($koneksi)."-".mysqli_error($koneksi));
                                            } 
                                            $data = mysqli_fetch_assoc($hasil);
                                            if (!count($data)) {
                                                echo "<script>alert('Data tidak ditemukan di database');window.location='kamar.php';</script>";
                                            }
                                            
                                        } 
                                        
                                        ?>
                                    <div class="col md-12">        
                                        <div class="card">
                                            <div class="card-body">
                                                <p>Nama Pemesan : <?php echo $data['nama_pemesan']; ?></p>
                                                <p>Email Pemesan : <?php echo $data['email_pemesan']; ?></p>
                                                <p>Hp Pemesan : <?php echo $data['hp_pemesan']; ?></p>
                                                <p>Nama Tamu : <?php echo $data['nama_tamu']; ?></p>
                                                <p>Kode Pesanan : <?php echo $data['kode_pesan']; ?></p>
                                                <p>Tipe Kamar :
                                                    <?php 
                                                            $kamar = mysqli_query($koneksi, "select * from kamar");
                                                            while ($a = mysqli_fetch_array($kamar)) {
                                                                if ($a['id_kamar'] == $data['id_kamar']) { ?>
                                                    <?php echo $a['no_kamar']; ?>
                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                </p>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12 table-responsive">
                                                        <table border="1" class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Tanggal Check-in</th>
                                                                    <th>Tanggal Check-out</th>
                                                                    <th>Jumlah Kamar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $data['cek_in']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $data['cek_out']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $data['jml_kamar']; ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            
                                                <br>

                                                <div
                                                    style="background-color:#cfb380; border: 3px #cfb380 double; padding: 10px; text-align: left;">
                                                    Print halaman ini dan tunjukkan kepada resepsionis saat akan check-in.
                                                </div>
                                                <br>
                                                <div style="text-align:right;">
                                                    <a class="no-print btn btn-primary" href="javascript:printDiv('print-area-3');">
                                                        <i class="fas fa-print"></i>
                                                        Print</a>
                                                </div>

                                                <br>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

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


    <script>
    function printDiv(elementId) {
        var a = document.getElementById('printing-css').value;
        var b = document.getElementById(elementId).innerHTML;
        window.frames["print_frame"].document.title = document.title;
        window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
    </script>

    <textarea id="printing-css"
        style="display:none;">html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}body{font:normal normal .8125em/1.4 Arial,Sans-Serif;background-color:white;color:#333}strong,b{font-weight:bold}cite,em,i{font-style:italic}a{text-decoration:none}a:hover{text-decoration:underline}a img{border:none}abbr,acronym{border-bottom:1px dotted;cursor:help}sup,sub{vertical-align:baseline;position:relative;top:-.4em;font-size:86%}sub{top:.4em}small{font-size:86%}kbd{font-size:80%;border:1px solid #999;padding:2px 5px;border-bottom-width:2px;border-radius:3px}mark{background-color:#ffce00;color:black}p,blockquote,pre,table,figure,hr,form,ol,ul,dl{margin:1.5em 0}hr{height:1px;border:none;background-color:#666}h1,h2,h3,h4,h5,h6{font-weight:bold;line-height:normal;margin:1.5em 0 0}h1{font-size:200%}h2{font-size:180%}h3{font-size:160%}h4{font-size:140%}h5{font-size:120%}h6{font-size:100%}ol,ul,dl{margin-left:3em}ol{list-style:decimal outside}ul{list-style:disc outside}li{margin:.5em 0}dt{font-weight:bold}dd{margin:0 0 .5em 2em}input,button,select,textarea{font:inherit;font-size:100%;line-height:normal;vertical-align:baseline}textarea{display:block;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}pre,code{font-family:"Courier New",Courier,Monospace;color:inherit}pre{white-space:pre;word-wrap:normal;overflow:auto}blockquote{margin-left:2em;margin-right:2em;border-left:4px solid #ccc;padding-left:1em;font-style:italic}table[border="1"] th,table[border="1"] td,table[border="1"] caption{border:1px solid;padding:.5em 1em;text-align:left;vertical-align:top}th{font-weight:bold}table[border="1"] caption{border:none;font-style:italic}.no-print{display:none}</textarea>
    <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>

</body>

</html>