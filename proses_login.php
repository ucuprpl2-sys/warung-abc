<?php
// proses_login.php
session_start();
include 'config/koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

// Query pencarian user
$sql   = "SELECT * FROM tbl_user WHERE username = '$username'";
$hasil = mysqli_query($koneksi, $sql);

if ($hasil && mysqli_num_rows($hasil) == 1) {
    $data = mysqli_fetch_assoc($hasil);

    // Cek password (mendukung password_hash maupun password biasa)
    $password_cocok = false;
    if (password_verify($password, $data['password']) || $password == $data['password']) {
        $password_cocok = true;
    }

    if ($password_cocok) {
        // Buat Session
        $_SESSION['login']        = true;
        $_SESSION['id_user']      = $data['id_user'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['role']         = $data['role'];

        // Catat Log Aktivitas (Abaikan jika tabel tbl_log belum ada)
        $id_user = $data['id_user'];
        $waktu   = date('Y-m-d H:i:s');
        $log     = "INSERT INTO tbl_log (id_user, aktivitas, waktu) VALUES ('$id_user', 'Login', '$waktu')";
        mysqli_query($koneksi, $log);

        // Redirect ke Dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['pesan_error'] = 'Password salah!';
        header('Location: login.php');
        exit;
    }
} else {
    $_SESSION['pesan_error'] = 'Username tidak ditemukan!';
    header('Location: login.php');
    exit;
}
?>