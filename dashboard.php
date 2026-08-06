<?php
// dashboard.php
include 'includes/cek_session.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Warung ABC</title>

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

/* Header */
.header{
    background:#fff;
    padding:18px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}

.header h2{
    color:#007BFF;
}

.logout{
    background:#dc3545;
    color:#fff;
    padding:10px 18px;
    text-decoration:none;
    border-radius:8px;
    transition:.3s;
}

.logout:hover{
    background:#b02a37;
}

/* Container */
.container{
    width:90%;
    max-width:1100px;
    margin:40px auto;
}

/* Welcome Card */
.card{
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 20px rgba(0,0,0,.15);
    margin-bottom:30px;
}

.card h1{
    color:#333;
    margin-bottom:10px;
}

.card p{
    color:#666;
    font-size:18px;
}

/* Menu */
.menu{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.menu a{
    text-decoration:none;
    color:#fff;
    padding:30px;
    border-radius:15px;
    text-align:center;
    font-size:48px; /* Emoji lebih besar */
    font-weight:bold;
    transition:.3s;
    box-shadow:0 8px 20px rgba(0,0,0,.15);
}

.menu a:hover{
    transform:translateY(-8px);
}

.menu a span{
    display:block;
    font-size:20px;
    margin-top:10px;
}

.barang{
    background:linear-gradient(135deg,#28a745,#20c997);
}

.transaksi{
    background:linear-gradient(135deg,#17a2b8,#0dcaf0);
}

.riwayat{
    background:linear-gradient(135deg,#ffc107,#ff9800);
    color:#333 !important;
}

/* Footer */
.footer{
    text-align:center;
    color:#fff;
    margin-top:40px;
    padding:20px;
}

@media(max-width:768px){
    .header{
        flex-direction:column;
        gap:10px;
    }

    .menu a{
        font-size:40px;
    }

    .menu a span{
        font-size:18px;
    }
}
</style>

</head>
<body>

<div class="header">
    <h2>🛒 Warung ABC</h2>
    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="container">

    <div class="card">
        <h1>Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?> 👋</h1>
        <p><strong>Role:</strong> <?php echo ucfirst($_SESSION['role']); ?></p>
    </div>

    <div class="menu">

        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'gudang') { ?>
        <a href="data_barang.php" class="barang">
            📦
            <span>Data Barang</span>
        </a>
        <?php } ?>

        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir') { ?>

        <a href="transaksi.php" class="transaksi">
            🛒
            <span>Transaksi Kasir</span>
        </a>

        <a href="riwayat_transaksi.php" class="riwayat">
            📋
            <span>Riwayat Transaksi</span>
        </a>

        <?php } ?>

    </div>

    <div class="footer">
        &copy; <?php echo date('Y'); ?> Sistem Kasir Warung ABC
    </div>

</div>

</body>
</html>