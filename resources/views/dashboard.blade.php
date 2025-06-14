@extends('layouts.app')

@section('content')
<style>
    .dashboard-sidebar {
        background: #f8fafc;
        min-height: 100vh;
        border-right: 1px solid #e5e7eb;
        padding-top: 2rem;
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
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        margin-left: 0.5rem;
    }
    .dashboard-main {
        background: #f8fafc;
        min-height: 100vh;
        padding: 2rem 2.5rem;
    }
    .stat-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-width: 200px;
        min-height: 110px;
    }
    .stat-card .stat-label {
        font-size: 1.1rem;
        color: #222;
        font-weight: 500;
    }
    .stat-card .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 0.25rem;
    }
    .stat-card .stat-change {
        font-size: 1rem;
        font-weight: 500;
    }
    .stat-card .stat-change.up { color: #16a34a; }
    .stat-card .stat-change.down { color: #e30613; }
    .dashboard-tabs .btn {
        border-radius: 8px;
        font-weight: 500;
        color: #222;
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        margin-right: 0.5rem;
    }
    .dashboard-tabs .btn.active, .dashboard-tabs .btn:focus, .dashboard-tabs .btn:hover {
        background: #e6f0fa;
        color: #0082C3;
        border-color: #0082C3;
    }
    .stat-row .stat-card {
        min-width: 170px;
        min-height: 90px;
        margin-bottom: 0;
        margin-right: 1rem;
    }
    .stat-row .stat-card:last-child { margin-right: 0; }
    .chart-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
        min-height: 320px;
    }
    .chart-placeholder, .pie-placeholder {
        background: #f8fafc;
        border-radius: 12px;
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #888;
        font-size: 1.2em;
    }
    .pie-placeholder { height: 220px; }
    .dashboard-footer {
        color: #888;
        font-size: 0.95em;
        margin-top: 2rem;
        margin-left: 1rem;
    }
</style>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="dashboard-sidebar px-3">
        <h5>Dashboard</h5>
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
                        <li class="nav-item"><a class="nav-link" href="#">View Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}">Add Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Edit Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Delete Users</a></li>
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
    <div class="flex-grow-1">
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
                <button class="icon-btn"><i class="bi bi-gear"></i></button>
            </div>
        </div>
        <!-- Main Content -->
        <div class="dashboard-main">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="stat-card">
                        <div class="stat-label">Revenue</div>
                        <div class="stat-value">1,125 KTS</div>
                        <div class="stat-change up"><i class="bi bi-arrow-up-right"></i> 5.2%</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <div class="stat-label">Expenses</div>
                        <div class="stat-value">724.1 KTS</div>
                        <div class="stat-change down"><i class="bi bi-arrow-down-right"></i> 2.9%</div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3">
                <div class="dashboard-tabs">
                    <button class="btn active">10 Day</button>
                    <button class="btn">Week</button>
                    <button class="btn">Month</button>
                    <button class="btn">Year</button>
                </div>
                <button class="btn btn-dark ms-auto" style="border-radius: 8px; font-weight: 500;">Sales Tracking</button>
            </div>
            <div class="d-flex stat-row mb-4">
                <div class="stat-card border border-2 border-dark">
                    <div class="stat-label">Total Sales</div>
                    <div class="stat-value">850 KTS</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Orders</div>
                    <div class="stat-value">725</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Avg. Sale</div>
                    <div class="stat-value">125 KTS</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Products</div>
                    <div class="stat-value">123</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Top Selling Products</div>
                    <div class="stat-value">7 / 25</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Visitors</div>
                    <div class="stat-value">285</div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="chart-card">
                        <div class="fw-bold mb-2" style="font-size: 1.2rem;">Shopping Stats</div>
                        <div class="chart-placeholder">[Line Chart Placeholder]</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="chart-card">
                        <div class="fw-bold mb-2" style="font-size: 1.2rem;">Users</div>
                        <div class="pie-placeholder">[Pie Chart Placeholder]</div>
                        <div class="mt-2 small">
                            <span style="color:#0082C3;">Admin (35%)</span> &nbsp;
                            <span style="color:#2CA6B0;">Retailers (20%)</span> &nbsp;
                            <span style="color:#7C3AED;">Cashiers (39%)</span> &nbsp;
                            <span style="color:#E30613;">Managers (6%)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection 