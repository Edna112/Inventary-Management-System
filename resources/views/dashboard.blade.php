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
        body { background: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #fff; box-shadow: 2px 0 8px rgba(0,0,0,0.03); }
        .sidebar .nav-link { color: #333; }
        .sidebar .nav-link.active { background: #e9ecef; font-weight: bold; }
        .dashboard-cards .card { min-width: 180px; }
        .chart-placeholder { background: #e9ecef; height: 220px; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #888; }
        .pie-placeholder { background: #e9ecef; height: 180px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #888; }
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
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
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
                    <button class="btn btn-outline-primary">10 day</button>
                    <button class="btn btn-outline-primary">week</button>
                    <button class="btn btn-outline-primary">month</button>
                    <button class="btn btn-outline-primary">year</button>
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