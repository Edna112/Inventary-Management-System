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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Roboto', Arial, Helvetica, sans-serif; background: #f8fafc; }
        .dashboard-sidebar {
            background: #f8fafc;
            min-height: 100vh;
            border-right: 1px solid #e5e7eb;
            padding-top: 2rem;
            min-width: 260px;
            max-width: 300px;
        }
        .dashboard-sidebar .nav-link {
            color: #222;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: background 0.2s, color 0.2s;
        }
        .dashboard-sidebar .nav-link.active, .dashboard-sidebar .nav-link:hover {
            background: #e6f0fa;
            color: #0082C3;
        }
        .dashboard-sidebar .nav-link i {
            font-size: 1.2rem;
        }
        .dashboard-sidebar h5 {
            font-weight: 700;
            margin-bottom: 2rem;
            color: #222;
            letter-spacing: 1px;
        }
        .dashboard-sidebar .nav-link.d-flex.justify-content-between.align-items-center {
            cursor: pointer;
        }
        .dashboard-sidebar .collapse .nav-link {
            color: #444;
            font-size: 0.97em;
        }
        .dashboard-footer {
            color: #888;
            font-size: 0.95em;
            margin-top: 2rem;
            margin-left: 1rem;
        }
        .dashboard-topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .dashboard-search {
            width: 350px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
        .dashboard-topbar .icon-btn {
            background: #f8fafc;
            border: none;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 0.5rem;
            color: #222;
            font-size: 1.2rem;
            transition: background 0.2s;
        }
        .dashboard-topbar .icon-btn:hover {
            background: #e6f0fa;
            color: #0082C3;
        }
        .dashboard-topbar .user-badge {
            background: #222b45;
            color: #fff;
            border-radius: 50%;
            width: 42px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            margin-left: 0.5rem;
        }
        @media (max-width: 991px) {
            .dashboard-sidebar { min-width: 60px; }
            .dashboard-sidebar h5, .dashboard-sidebar .nav-link { font-size: 0.95em; }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="dashboard-sidebar px-3">
            <h5><a href="{{ route('dashboard') }}" style="color: #222; text-decoration: none;">DASHBOARD</a></h5>
            <ul class="nav flex-column">
                <!-- Products Dropdown -->
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#productsMenu" role="button" aria-expanded="false" aria-controls="productsMenu">
                        <span><i class="bi bi-box-seam"></i> Products</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <div class="collapse" id="productsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">List Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Add Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Edit Products</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Delete Products</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Users Dropdown -->
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#usersMenu" role="button" aria-expanded="false" aria-controls="usersMenu">
                        <span><i class="bi bi-person"></i> Users</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <div class="collapse" id="usersMenu">
                        <ul class="nav flex-column ms-3">
                            {{-- <li class="nav-item"><a class="nav-link" href="#">View Users</a></li> --}}
                            <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">View Users</a></li>
                            @php
                                $user = Auth::user();
                            @endphp
                            @if($user && $user->role === 'admin')
                                <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}">Add Users</a></li>
                            @endif
                            {{-- <li class="nav-item"><a class="nav-link" href="{{ route('users.edit') }}">Edit Users</a></li> --}}
                            {{-- <li class="nav-item"><a class="nav-link" href="#">Delete Users</a></li> --}}
                        </ul>
                    </div>
                </li>
                <!-- Inventory Dropdown -->
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#inventoryMenu" role="button" aria-expanded="false" aria-controls="inventoryMenu">
                        <span><i class="bi bi-layers"></i> Inventory</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <div class="collapse" id="inventoryMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">Stock List</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Purchase</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Supplier</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Return</a></li>
                        </ul>
                    </div>
                </li>
                <!-- POS Points Dropdown -->
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#posMenu" role="button" aria-expanded="false" aria-controls="posMenu">
                        <span><i class="bi bi-graph-up"></i> POS Points</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <div class="collapse" id="posMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">View</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Edit</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Add</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Delete</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Reports Dropdown -->
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#reportsMenu" role="button" aria-expanded="false" aria-controls="reportsMenu">
                        <span><i class="bi bi-bar-chart"></i> Reports</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <div class="collapse" id="reportsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">Sales Reports</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Inventory Reports</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">User Activity Reports</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Accounts Dropdown -->
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#accountsMenu" role="button" aria-expanded="false" aria-controls="accountsMenu">
                        <span><i class="bi bi-wallet2"></i> Accounts</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
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
                <!-- Settings Dropdown -->
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#settingsMenu" role="button" aria-expanded="false" aria-controls="settingsMenu">
                        <span><i class="bi bi-gear"></i> Settings</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <div class="collapse" id="settingsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">General Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Notification Settings</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <div class="dashboard-footer">© 2025</div>
        </nav>
        <!-- Main Content Area with Topbar -->
        <div class="flex-grow-1" style="min-width:0;">
            <!-- Topbar -->
            <div class="dashboard-topbar">
                <form class="d-flex align-items-center" style="flex:1;">
                    <input class="dashboard-search" type="search" placeholder="Search..." aria-label="Search">
                    <button class="btn icon-btn" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <div class="d-flex align-items-center">
                    <button class="icon-btn"><i class="bi bi-bell"></i></button>
                    <button class="icon-btn"><i class="bi bi-people"></i></button>
                    <span class="user-badge ms-2">A</span>
                    <div class="dropdown">
                        <button class="icon-btn" type="button" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Main Content -->
            @yield('content')
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 