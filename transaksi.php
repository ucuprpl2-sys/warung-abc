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
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaksi - Warung ABC</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:linear-gradient(135deg,#4facfe,#00c6fb);
    min-height:100vh;
}

.container{
    width:95%;
    max-width:1100px;
    margin:40px auto;
}

.card{
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

h1{
    color:#333;
    margin-bottom:25px;
}

h3{
    margin:25px 0 15px;
    color:#555;
}


/* Pesan Error */
.error{
    background:#f8d7da;
    color:#842029;
    padding:12px;
    border-radius:8px;
    margin-bottom:20px;
}


/* Form */
.form-box{
    background:#f8f9fa;
    padding:20px;
    border-radius:12px;
}

select,
input[type="number"]{
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    margin:5px;
    font-size:15px;
}


button,
input[type="submit"]{
    background:#007BFF;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    transition:.3s;
}

button:hover,
input[type="submit"]:hover{
    background:#0056b3;
}


/* Table */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
    overflow:hidden;
    border-radius:10px;
}

table th{
    background:#17a2b8;
    color:white;
    padding:14px;
}

table td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

table tr:nth-child(even){
    background:#f8f9fa;x
}

table tr:hover{
    background:#e9f5ff;
}


/* Hapus */
.hapus{
    color:#dc3545;
    text-decoration:none;
    font-weight:bold;
}

.hapus:hover{
    text-decoration:underline;
}


/* Total */
.total{
    background:#ffc107;
    font-weight:bold;
}


/* Tombol simpan */
.simpan{
    margin-top:25px;
    background:#28a745;
}

.simpan:hover{
    background:#218838;
}


.dashboard{
    display:inline-block;
    margin-top:20px;
    background:#6c757d;
    color:white;
    padding:12px 20px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}

.dashboard:hover{
    background:#5a6268;
}


@media(max-width:768px){

    table{
        font-size:14px;
    }

    select,
    input[type="number"]{
        width:100%;
        margin:5px 0;
    }

    input[type="submit"]{
        width:100%;
    }
}

</style>

</head>

<body>

<div class="container">

<div class="card">

<h1>🛒 Transaksi Penjualan</h1>


<?php if (isset($_SESSION['pesan_error'])) { ?>

<div class="error">
    <?php 
        echo $_SESSION['pesan_error'];
        unset($_SESSION['pesan_error']);
    ?>
</div>

<?php } ?>


<h3>Pilih Barang</h3>

<div class="form-box">

<form action="proses_tambah_keranjang.php" method="POST">

<select name="id_barang" required>

<?php while ($b = mysqli_fetch_assoc($daftar_barang)) { ?>

<option value="<?php echo $b['id_barang']; ?>">
<?php echo $b['nama_barang'].' (Stok: '.$b['stok'].')'; ?>
</option>

<?php } ?>

</select>


<input type="number" name="jumlah" min="1" placeholder="Jumlah" required>


<input type="submit" value="➕ Tambah Keranjang">

</form>

</div>



<h3>Keranjang Belanja</h3>


<table>

<tr>
<th>Nama Barang</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Subtotal</th>
<th>Aksi</th>
</tr>


<?php foreach ($_SESSION['keranjang'] as $id_barang => $item) { ?>

<tr>

<td><?php echo $item['nama_barang']; ?></td>

<td>
Rp <?php echo number_format($item['harga'],0,',','.'); ?>
</td>

<td>
<?php echo $item['jumlah']; ?>
</td>

<td>
Rp <?php echo number_format($item['subtotal'],0,',','.'); ?>
</td>

<td>
<a class="hapus" href="hapus_keranjang.php?id=<?php echo $id_barang; ?>">
🗑 Hapus
</a>
</td>

</tr>

<?php } ?>


<tr class="total">

<td colspan="3">
TOTAL
</td>

<td colspan="2">
Rp <?php echo number_format($total,0,',','.'); ?>
</td>

</tr>


</table>



<form action="proses_simpan_transaksi.php" method="POST">

<input class="simpan" type="submit" value="💾 Simpan Transaksi">

</form>


<a class="dashboard" href="dashboard.php">
🏠 Kembali Dashboard
</a>


</div>

</div>

</body>
</html>