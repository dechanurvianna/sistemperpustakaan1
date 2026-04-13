<!DOCTYPE html>
<html>
<head>
<title>Login Sistem Perpustakaan</title>
<style>

body{
    font-family: Arial, sans-serif;
    background:#f2f2f2;
}

.container{
    width:400px;
    margin:100px auto;
    background:white;
    padding:40px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
    border-radius:6px;
}

h2{
    margin-bottom:5px;
}

p{
    color:gray;
    margin-bottom:20px;
}

input[type=text], input[type=password]{
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
    border-radius:6px;
    margin-top:10px;
}

button:hover{
    background:#1565c0;
}

.row{
    display:flex;
    justify-content:space-between;
    align-items:center;
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
<p>Masuk untuk melanjutkan</p>

<form method="POST" action="{{ route('login') }}">
    @csrf

    @if (session('error'))
        <div style="color: red; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif

    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">

    <button type="submit">Login</button>
</form>

<div class="row">
<label><input type="checkbox"> Biarkan saya tetap masuk</label>
<a href="/lupa-password">Lupa kata sandi?</a>
</div>

<div class="footer">
Belum punya akun? <a href="/register">Buat Akun</a>
</div>

</div>

</body>
</html>
