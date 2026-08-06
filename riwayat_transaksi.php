<?php
// riwayat_transaksi.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT t.no_transaksi, t.tanggal, t.total_bayar, u.nama_lengkap AS nama_kasir
        FROM tbl_transaksi t
        JOIN tbl_user u ON t.id_kasir = u.id_user
        ORDER BY t.tanggal DESC";

$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Riwayat Transaksi - Warung ABC</title>

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



/* Table */

table{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:12px;
}


table th{
    background:#ffc107;
    color:#333;
    padding:15px;
    font-size:16px;
}


table td{
    padding:13px;
    text-align:center;
    border-bottom:1px solid #ddd;
    color:#555;
}


table tr:nth-child(even){
    background:#f8f9fa;
}


table tr:hover{
    background:#fff3cd;
    transition:.3s;
}



/* Total */

td:last-child{
    font-weight:bold;
    color:#198754;
}



/* Tombol Dashboard */

.dashboard{
    display:inline-block;
    margin-top:25px;
    background:#17a2b8;
    color:white;
    text-decoration:none;
    padding:12px 20px;
    border-radius:8px;
    font-weight:bold;
    transition:.3s;
}


.dashboard:hover{
    background:#138496;
    transform:translateY(-3px);
}



@media(max-width:768px){

    table{
        font-size:14px;
    }

    .card{
        padding:20px;
    }

    h1{
        font-size:25px;
    }

}

</style>

</head>


<body>


<div class="container">

<div class="card">


<h1>📋 Riwayat Transaksi</h1>


<table>

<tr>
    <th>No. Transaksi</th>
    <th>Tanggal</th>
    <th>Kasir</th>
    <th>Total Bayar</th>
</tr>


<?php while ($row = mysqli_fetch_assoc($hasil)) { ?>

<tr>

    <td>
        <?php echo $row['no_transaksi']; ?>
    </td>


    <td>
        <?php echo $row['tanggal']; ?>
    </td>


    <td>
        👤 <?php echo $row['nama_kasir']; ?>
    </td>


    <td>
        Rp <?php echo number_format($row['total_bayar'],0,',','.'); ?>
    </td>

</tr>


<?php } ?>


</table>


<a href="dashboard.php" class="dashboard">
🏠 Kembali ke Dashboard
</a>


</div>

</div>


</body>
</html>