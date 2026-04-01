<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password</title>
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

.footer{
    text-align:center;
    margin-top:20px;
}

.footer a{
    color:#1e88e5;
    text-decoration:none;
}

</style>
</head>

<body>

<div class="container">

<h2>Reset Password</h2>
<p>Masukkan password baru</p>

<form>
    <input type="text" placeholder="Username">
    <input type="password" placeholder="Password Baru">
    <input type="password" placeholder="Konfirmasi Password">

    <button type="submit">Reset Password</button>
</form>

<div class="footer">
    Sudah ingat password? <a href="/login">Login</a>
</div>

</div>

</body>
</html>