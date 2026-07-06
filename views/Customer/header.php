<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Abed Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { background-color: #f4f6f9; display: flex; flex-direction: column; min-height: 100vh; font-family: 'Inter', sans-serif; }
        .navbar { padding: 0.8rem 0; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; letter-spacing: 0.5px; }
        .product-card { transition: all 0.3s ease; border-radius: 16px; overflow: hidden; border: 1px solid rgba(0,0,0,0.05); }
        .product-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.08)!important; }
        .product-card img { height: 220px; object-fit: contain; padding: 25px; background-color: #fff; transition: transform 0.3s; }
        .product-card:hover img { transform: scale(1.05); }
        .content-wrapper { flex: 1; }
        .btn-primary { background-color: #0d6efd; border: none; padding: 10px 24px; font-weight: 600; border-radius: 8px; }
        .btn-primary:hover { background-color: #0b5ed7; box-shadow: 0 4px 15px rgba(13,110,253,0.35); transform: translateY(-1px); }
        .badge-cart { transition: transform 0.2s; }
        .nav-link:hover .badge-cart { transform: scale(1.2); }
        .hero-carousel .carousel-item { height: 500px; border-radius: 20px; overflow: hidden; }
        .hero-carousel img { object-fit: cover; height: 100%; width: 100%; filter: brightness(0.6); }
        .hero-caption { bottom: 30%; text-align: left; left: 10%; right: 10%; }
        .feature-icon { width: 60px; height: 60px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; background-color: rgba(13,110,253,0.1); color: #0d6efd; font-size: 1.5rem; margin-bottom: 1rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand text-white" href="index.php"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Abed Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link text-light fw-medium px-3" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-light fw-medium px-3" href="products.php">Shop</a></li>
            </ul>
            <form class="d-flex me-4 d-none d-lg-flex" role="search" action="products.php" method="GET">
                <div class="input-group">
                    <input class="form-control border-0 bg-light" type="search" placeholder="Search..." name="search" aria-label="Search" style="border-radius: 20px 0 0 20px;">
                    <button class="btn btn-light" type="submit" style="border-radius: 0 20px 20px 0;"><i class="bi bi-search text-muted"></i></button>
                </div>
            </form>
            <ul class="navbar-nav align-items-center">
                <li class="nav-item me-4">
                    <a class="nav-link text-light position-relative" href="cart.php">
                        <i class="bi bi-bag fs-5"></i> 
                        <span class="position-absolute top-10 start-100 translate-middle badge rounded-pill bg-warning text-dark badge-cart">
                            <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                        </span>
                    </a>
                </li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light fw-bold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['full_name']) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3">
                            <li><a class="dropdown-item py-2" href="orders.php"><i class="bi bi-box me-2 text-primary"></i>My Orders</a></li>
                            <?php if($_SESSION['role_id'] == 1): ?>
                                <li><a class="dropdown-item py-2" href="../Admin/Dashboard.php"><i class="bi bi-speedometer2 me-2 text-success"></i>Admin Panel</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item py-2 text-danger" href="../../services/Auth/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm me-2 fw-medium px-3 rounded-pill" href="../Auth/login.php">Login</a></li>
                    <li class="nav-item"><a class="btn btn-warning btn-sm fw-bold px-3 text-dark rounded-pill shadow-sm" href="../Auth/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="content-wrapper">
