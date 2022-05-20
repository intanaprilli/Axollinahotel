<?php
include '../koneksi.php';   


if(isset($_POST['tambahkamarcheckout'])){
    $id_kamar = $_POST['id_kamar'];
    $qty = $_POST['qty'];
    $id_pesanan = $_POST['id_pesanan'];

    $cekstocksekarang = mysqli_query($koneksi, "SELECT * FROM kamar WHERE id_kamar='$id_kamar'");
    $ambildata = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildata['stok'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtotambahkamar = mysqli_query($koneksi,"INSERT INTO limit_kamar (id_kamar,qty) VALUES ('$id_kamar','$qty')");
    $updatestockkamar = mysqli_query($koneksi,"UPDATE kamar set stok = '$tambahkanstocksekarangdenganquantity' where id_kamar='$id_kamar'");
    $hapus = mysqli_query($koneksi,"DELETE FROM pesanan WHERE id_pesanan = '$id_pesanan'");

    if ($addtotambahkamar&&$updatestockkamar&&$hapus) {
        echo "<script>alert('Data berhasil di Checkout.');window.location='pesanan.php';</script>";
    } else {
        echo "<script>alert('Data gagal di checkout.');window.location='pesanan.php';</script>";
    }
    }
?>