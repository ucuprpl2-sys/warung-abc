<?php
// data_barang.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT * FROM tbl_barang ORDER BY nama_barang ASC";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Barang - Warung ABC</title>

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
    max-width:1200px;
    margin:40px auto;
}

.card{
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}

h1{
    color:#333;
    margin-bottom:20px;
}

.menu{
    margin-bottom:20px;
}

.menu a{
    display:inline-block;
    text-decoration:none;
    color:#fff;
    padding:10px 18px;
    border-radius:8px;
    margin-right:10px;
    transition:.3s;
    font-weight:bold;
}

.dashboard{
    background:#17a2b8;
}

.dashboard:hover{
    background:#138496;
}

.tambah{
    background:#28a745;
}

.tambah:hover{
    background:#218838;
}

table{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:10px;
}

table th{
    background:#007BFF;
    color:#fff;
    padding:14px;
}

table td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

table tr:nth-child(even){
    background:#f8f9fa;
}

table tr:hover{
    background:#e9f5ff;
}

.edit{
    color:#0d6efd;
    text-decoration:none;
    font-weight:bold;
}

.hapus{
    color:#dc3545;
    text-decoration:none;
    font-weight:bold;
}

.edit:hover,
.hapus:hover{
    text-decoration:underline;
}

@media(max-width:768px){

    table{
        font-size:14px;
    }

    .menu a{
        margin-bottom:10px;
    }
}
</style>

</head>
<body>

<div class="container">

    <div class="card">

        <h1>📦 Data Barang</h1>

        <div class="menu">
            <a href="dashboard.php" class="dashboard">🏠 Dashboard</a>
            <a href="tambah_barang.php" class="tambah">➕ Tambah Barang</a>
        </div>

        <table>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Stok</th>
                <th>Kadaluarsa</th>
                <th>Aksi</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
            <tr>
                <td><?php echo $row['kode_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td>Rp <?php echo number_format($row['harga_satuan'],0,',','.'); ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $row['tanggal_kadaluarsa']; ?></td>
                <td>
                    <a class="edit" href="edit_barang.php?id=<?php echo $row['id_barang']; ?>">✏ Edit</a>
                    |
                    <a class="hapus"
                       href="hapus_barang.php?id=<?php echo $row['id_barang']; ?>"
                       onclick="return confirm('Yakin hapus barang ini?');">
                       🗑 Hapus
                    </a>
                </td>
            </tr>
            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>