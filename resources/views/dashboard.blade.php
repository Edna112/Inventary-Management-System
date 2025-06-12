<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Inventory Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --ims-primary: #0082C3;
            --ims-accent: #E30613;
            --ims-teal: #2CA6B0;
            --ims-bg: #FFFFFF;
            --ims-text: #222;
        }
        body { background: var(--ims-bg); color: var(--ims-text); }
        .sidebar {
            min-height: 100vh;
            background: var(--ims-primary);
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
            background: var(--ims-teal);
            color: #fff;
        }
        .sidebar .collapse .nav-link {
            color: #d0e8f6;
            font-size: 0.97em;
        }
        .navbar {
            background: var(--ims-bg) !important;
            border-bottom: 2px solid var(--ims-primary);
        }
        .navbar .form-control {
            border-radius: 20px;
            border: 1px solid var(--ims-teal);
        }
        .navbar .btn-outline-secondary {
            color: var(--ims-primary);
            border-color: var(--ims-primary);
        }
        .navbar .btn-outline-secondary:hover {
            background: var(--ims-primary);
            color: #fff;
        }
        .navbar .badge.bg-primary {
            background: var(--ims-accent) !important;
            color: #fff;
            font-size: 1em;
        }
        .navbar .btn-outline-danger {
            border-radius: 20px;
            border-color: var(--ims-accent);
            color: var(--ims-accent);
        }
        .navbar .btn-outline-danger:hover {
            background: var(--ims-accent);
            color: #fff;
        }
        .dashboard-cards .card {
            min-width: 180px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,130,195,0.07);
        }
        .dashboard-cards .card-body {
            padding: 1.2rem 1rem;
        }
        .dashboard-cards .card h6 {
            color: var(--ims-primary);
            font-weight: 600;
        }
        .dashboard-cards .card h5 {
            color: var(--ims-accent);
            font-weight: 700;
        }
        .dashboard-cards .btn-primary {
            background: var(--ims-primary);
            border: none;
        }
        .dashboard-cards .btn-primary:hover {
            background: var(--ims-teal);
        }
        .btn-group .btn {
            border-radius: 20px !important;
            color: var(--ims-primary);
            border-color: var(--ims-primary);
            background: #fff;
        }
        .btn-group .btn.active, .btn-group .btn:focus, .btn-group .btn:hover {
            background: var(--ims-primary);
            color: #fff;
        }
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,130,195,0.07);
        }
        .card h6 {
            color: var(--ims-primary);
            font-weight: 600;
        }
        .chart-placeholder {
            background: #e9ecef;
            height: 220px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-size: 1.2em;
        }
        .pie-placeholder {
            background: #e9ecef;
            height: 180px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-size: 1.1em;
        }
        .small span {
            color: var(--ims-primary);
            font-weight: 500;
        }
        @media (max-width: 991px) {
            .sidebar { min-width: 60px; }
            .sidebar h5, .sidebar .nav-link { font-size: 0.95em; }
        }
    </style>
</head>
<body>
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
                        <li class="nav-item"><a class="nav-link" href="#">Add Users</a></li>
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
    <div class="flex-grow-1">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container-fluid">
                <form class="d-flex me-3" style="width: 300px;">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Q</button>
                </form>
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><i class="bi bi-bell"></i></a>
                    </li>
                    <li class="nav-item me-3">
                        <span class="badge bg-primary">Admin</span>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><i class="bi bi-person-circle"></i></a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Dashboard Content -->
        <div class="container-fluid mt-4">
            <!-- Summary Cards -->
            <div class="row dashboard-cards mb-3 g-3">
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Revenue</h6>
                            <h5>1,125 kts</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Expenses</h6>
                            <h5>724.1 kts</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Total Sales</h6>
                            <h5>8502 kts</h5>
                            <button class="btn btn-sm btn-primary mt-2">Details</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Orders</h6>
                            <h5>785</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Avg Sale</h6>
                            <h5>125 kts</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Visitors</h6>
                            <h5>254</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Time Filter -->
            <div class="mb-3">
                <div class="btn-group" role="group">
                    <button class="btn">10 day</button>
                    <button class="btn">week</button>
                    <button class="btn">month</button>
                    <button class="btn">year</button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-3 g-3">
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Total Products</h6>
                            <h5>127</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h6>Top Selling Products</h6>
                            <h5>7/25</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Shopping Status</h6>
                            <div class="chart-placeholder">[Line Chart Placeholder]</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>Users</h6>
                            <div class="pie-placeholder">[Pie Chart Placeholder]</div>
                            <div class="mt-2 small">
                                <span>45% Admin</span> <br>
                                <span>20% Clerks</span> <br>
                                <span>6% Managers</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Main Content -->
</div>

<!-- Bootstrap 5 JS and icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 