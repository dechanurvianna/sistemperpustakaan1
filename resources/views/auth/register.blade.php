<!DOCTYPE html>
<html>
<head>
    <title>Register - Sistem Perpustakaan</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f2f2f2;
        }

        .container{
            width:420px;
            margin:80px auto;
            background:white;
            padding:40px;
            border-radius:6px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        h2{
            margin-bottom:5px;
        }

        p{
            color:gray;
            margin-bottom:20px;
        }

        input{
            width:100%;
            padding:12px;
            margin:8px 0;
            border:1px solid #ccc;
            border-radius:4px;
        }

        button{
            width:100%;
            padding:12px;
            background:#1e88e5;
            border:none;
            color:white;
            font-size:16px;
            border-radius:8px;
            margin-top:10px;
            cursor:pointer;
        }

        button:hover{
            background:#1565c0;
        }

        .row{
            margin-top:10px;
            font-size:14px;
        }

        .footer{
            text-align:center;
            margin-top:25px;
        }

        .footer a{
            color:#1e88e5;
            text-decoration:none;
        }
    </style>
</head>

<body>

<div class="container">

<h2>Sistem Perpustakaan</h2>
<p>Buat akun baru untuk memulai</p>

<form method="POST" action="/register">
    @csrf

    <input type="text" name="name" placeholder="Nama Lengkap" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

    <button type="submit">Register</button>

    <div class="footer">
        Sudah punya akun? <a href="/login">Login</a>
    </div>
</form>

</div>

</body>
</html>
