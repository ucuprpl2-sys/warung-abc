<!-- login.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Warung ABC</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:linear-gradient(135deg,#4facfe,#00f2fe);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            background:#fff;
            width:380px;
            padding:35px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,.2);
        }

        .login-box h1{
            text-align:center;
            margin-bottom:10px;
            color:#333;
            font-size:28px;
        }

        .login-box p.subtitle{
            text-align:center;
            color:#777;
            margin-bottom:25px;
            font-size:14px;
        }

        table{
            width:100%;
        }

        td{
            padding:8px 0;
        }

        input[type=text],
        input[type=password]{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:8px;
            outline:none;
            transition:.3s;
        }

        input[type=text]:focus,
        input[type=password]:focus{
            border-color:#4facfe;
            box-shadow:0 0 8px rgba(79,172,254,.4);
        }

        input[type=submit]{
            width:100%;
            padding:12px;
            margin-top:15px;
            border:none;
            border-radius:8px;
            background:#4facfe;
            color:#fff;
            font-size:16px;
            cursor:pointer;
            transition:.3s;
        }

        input[type=submit]:hover{
            background:#1d8cf8;
        }

        .error{
            background:#ffe5e5;
            color:#c0392b;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
            text-align:center;
        }

        .footer{
            margin-top:20px;
            text-align:center;
            color:#888;
            font-size:12px;
        }
    </style>
</head>
<body>

<div class="login-box">

    <h1>Warung ABC</h1>
    <p class="subtitle">Login Aplikasi Kasir</p>

    <?php
    session_start();
    if (isset($_SESSION['pesan_error'])) {
        echo '<div class="error">' . $_SESSION['pesan_error'] . '</div>';
        unset($_SESSION['pesan_error']);
    }
    ?>

    <form action="proses_login.php" method="POST">
        <table>
            <tr>
                <td>Username</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="username" placeholder="Masukkan username" required>
                </td>
            </tr>

            <tr>
                <td>Password</td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login">
                </td>
            </tr>
        </table>
    </form>

    <div class="footer">
        &copy; <?php echo date('Y'); ?> Warung ABC
    </div>

</div>

</body>
</html>