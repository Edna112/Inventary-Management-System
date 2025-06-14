<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Inventory Management System')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Roboto Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', Arial, Helvetica, sans-serif; background: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: #0082C3;
            box-shadow: 2px 0 8px rgba(0,0,0,0.03);
        }
        .sidebar h5 { color: #fff; letter-spacing: 1px; }
        .sidebar .nav-link {
            color: #e3f4fb;
            border-radius: 4px;
            margin-bottom: 2px;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #2CA6B0;
            color: #fff;
        }
        .sidebar .collapse .nav-link {
            color: #d0e8f6;
            font-size: 0.97em;
        }
        @media (max-width: 991px) {
            .sidebar { min-width: 60px; }
            .sidebar h5, .sidebar .nav-link { font-size: 0.95em; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-0">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/dashboard') }}">IMS</a>
        </div>
    </nav>
    <div class="d-flex">
        @yield('content')
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 