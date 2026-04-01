<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Content -->
    <div class="flex-grow-1 p-4 bg-light">
        @yield('content')
    </div>
</div>

</body>
</html>
