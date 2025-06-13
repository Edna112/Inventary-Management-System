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
        <!-- Sidebar -->
        <nav class="sidebar p-3">
            <h5 class="mb-4">Dashboard</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link" data-bs-toggle="collapse" href="#productsMenu" role="button" aria-expanded="false">Products</a>
                    <div class="collapse" id="productsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">List Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Add Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Edit Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Delete Products</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" data-bs-toggle="collapse" href="#usersMenu" role="button" aria-expanded="false">Users</a>
                    <div class="collapse" id="usersMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">View Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}">Add Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Edit Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Delete Users</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" data-bs-toggle="collapse" href="#inventoryMenu" role="button" aria-expanded="false">Inventory</a>
                    <div class="collapse" id="inventoryMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">Stock List</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Purchase</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Supplier</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Return</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" data-bs-toggle="collapse" href="#posMenu" role="button" aria-expanded="false">POS Points</a>
                    <div class="collapse" id="posMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">View</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Edit</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Add</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Delete</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" data-bs-toggle="collapse" href="#reportsMenu" role="button" aria-expanded="false">Reports</a>
                    <div class="collapse" id="reportsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">Sales Reports</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Inventory Reports</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">User Activity Reports</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" data-bs-toggle="collapse" href="#accountsMenu" role="button" aria-expanded="false">Accounts</a>
                    <div class="collapse" id="accountsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">Invoices</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Expenses</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Add Expense</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Edit Expense</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Extract Invoice</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" data-bs-toggle="collapse" href="#settingsMenu" role="button" aria-expanded="false">Settings</a>
                    <div class="collapse" id="settingsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">General Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Notification Settings</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Main Content -->
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 