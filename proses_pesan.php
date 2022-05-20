<?php 
//Tambahkan Koneksi Databases
include 'koneksi.php';

//menerima data dari form
if(isset($_POST['kamardipesan'])) {
$cek_in = $_POST['cek_in'];
$cek_out = $_POST['cek_out'];
$jml_kamar = $_POST['jml_kamar'];
$nama_pemesan = $_POST['nama_pemesan'];
$email_pemesan = $_POST['email_pemesan'];
$hp_pemesan = $_POST['hp_pemesan'];
$nama_tamu = $_POST['nama_tamu'];
$id_kamar = $_POST['id_kamar'];
$kode_pesan = date('mdy').$_POST['id_kamar'];

$cekstocksekarang=mysqli_query($koneksi,"SELECT * FROM kamar WHERE id_kamar='$id_kamar'");
    $ambildata = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildata['stok'];

    if ($stocksekarang >= $jml_kamar)    {
        $tambahkanstocksekarangdenganquantity = $stocksekarang-$jml_kamar;

        $addtotambahkamar = mysqli_query($koneksi,"INSERT into pesanan values('','$cek_in','$cek_out','$jml_kamar','$nama_pemesan','$email_pemesan','$hp_pemesan','$nama_tamu','$id_kamar','1','$kode_pesan')");
        $updatestockkamar = mysqli_query($koneksi,"UPDATE kamar set stok = '$tambahkanstocksekarangdenganquantity' where id_kamar='$id_kamar'");

        if ($addtotambahkamar&&$updatestockkamar) {
                echo "<script>window.location='buku.php?nama_pemesan=$nama_pemesan'</script>";

        } else {
            header("location:index.php");
        }   
    }else{
        echo "<script>alert('Kamar Sudah Full !!'); window.location='index.php';</script>";
    }
    
        $ambildata = mysqli_fetch_array($cekstocksekarang);

    
}