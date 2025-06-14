@extends('layouts.app')

@section('content')
<style>
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
        min-width: 240px;
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
        min-width: 210px;
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
</style>
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
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection 