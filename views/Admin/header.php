<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header('Location: ../../views/Auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Abed Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .sidebar { min-height: 100vh; background-color: #1e1e2d; color: #fff; }
        .sidebar a { color: #9899ac; text-decoration: none; display: block; padding: 12px 20px; border-radius: 8px; margin-bottom: 8px; font-weight: 500; transition: all 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #2b2b40; color: #fff; transform: translateX(5px); }
        .sidebar a i { width: 25px; display: inline-block; font-size: 1.1rem; }
        .main-content { background-color: #f4f6f9; min-height: 100vh; }
        .card-stats { border-radius: 16px; border: none; overflow: hidden; transition: transform 0.3s; }
        .card-stats:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1)!important; }
        .icon-stats { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 1.8rem; }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar p-3 shadow-lg" style="width: 260px;">
        <h4 class="text-white mb-4 mt-2 border-bottom pb-3 text-center fw-bolder" style="letter-spacing: 1px;">
            <i class="bi bi-lightning-charge-fill text-warning me-2"></i>Admin
        </h4>
        <ul class="nav flex-column mt-4">
            <li class="nav-item"><a href="/Electronics_Store/views/Admin/Dashboard.php"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a></li>
            <li class="nav-item"><a href="/Electronics_Store/views/Admin/Categories/index.php"><i class="bi bi-tags-fill"></i> Categories</a></li>
            <li class="nav-item"><a href="/Electronics_Store/views/Admin/Products/index.php"><i class="bi bi-box-seam-fill"></i> Products</a></li>
            <li class="nav-item"><a href="/Electronics_Store/views/Admin/Users/index.php"><i class="bi bi-people-fill"></i> Users</a></li>
            <li class="nav-item"><a href="/Electronics_Store/views/Admin/Orders/index.php"><i class="bi bi-cart-check-fill"></i> Orders</a></li>
            <li class="nav-item mt-5"><a href="/Electronics_Store/views/Customer/index.php" class="text-info"><i class="bi bi-shop"></i> View Store</a></li>
            <li class="nav-item mt-2"><a href="/Electronics_Store/services/Auth/logout.php" class="text-danger bg-danger bg-opacity-10"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        </ul>
    </div>
    <div class="flex-grow-1 main-content p-5">
