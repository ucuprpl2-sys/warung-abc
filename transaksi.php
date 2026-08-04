<?php
// transaksi.php
session_start();
include 'includes/cek_session.php';
include 'config/koneksi.php';

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$daftar_barang = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE stok > 0");
$total = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['subtotal'];
}
?>
<!DOCTYPE html>
<html>
<head><title>Transaksi - Warung ABC</title></head>
<body>
    <h1>Transaksi Penjualan</h1>

    <?php if (isset($_SESSION['pesan_error'])) {
        echo '<p>' . $_SESSION['pesan_error'] . '</p>';
        unset($_SESSION['pesan_error']);
`w`    <h3>Pilih Barang</h3>
    <form action="proses_tambah_keranjang.php" method="POST">
        <select name="id_barang" required>
  …