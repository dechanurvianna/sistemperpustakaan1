<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS SIDEBAR (LANGSUNG DI SINI BIAR PASTI JALAN) -->
    <style>
        body {
            margin: 0;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: linear-gradient(180deg, #0d6efd, #0b5ed7);
            position: fixed;
            top: 0;
            left: 0;
            padding: 15px;
        }

        .sidebar h5 {
            color: #fff;
            font-weight: bold;
        }

        .sidebar .nav-link {
            color: #fff !important;
            margin-bottom: 8px;
            border-radius: 10px;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.2);
        }

        .sidebar .nav-link.active {
            background: #17a2b8;
        }

        .content {
            margin-left: 220px;
            min-height: 100vh;
            background: #f4f6f9;
        }
    </style>
</head>

<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    @include('layouts.backend.sidebar')

    <!-- CONTENT -->
    <div class="flex-grow-1 content">
        <div class="p-4">
            @yield('content')
        </div>
    </div>

</div>

</body>
</html>
