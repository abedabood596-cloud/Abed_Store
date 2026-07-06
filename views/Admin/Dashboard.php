<?php
require_once '../../config/db.php';
require_once 'header.php';

// Fetch stats
$usersCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$productsCount = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$ordersCount = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$totalRevenue = $pdo->query("SELECT SUM(total_amount) FROM orders WHERE status = 'Completed'")->fetchColumn() ?? 0;
?>

<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bolder mb-1">Dashboard Overview</h2>
        <p class="text-muted mb-0">Welcome back to your admin control panel.</p>
    </div>
    <div>
        <span class="text-muted"><i class="bi bi-calendar3 me-2"></i><?= date('F j, Y') ?></span>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6 col-lg-3">
        <div class="card card-stats bg-white shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted fw-bold text-uppercase mb-0" style="letter-spacing: 1px; font-size: 0.8rem;">Total Users</h6>
                    <div class="icon-stats text-primary bg-primary bg-opacity-10">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <h3 class="fw-bolder mb-0 fs-1"><?= $usersCount ?></h3>
                <div class="mt-3">
                    <span class="text-success small fw-bold"><i class="bi bi-arrow-up-right me-1"></i>+12%</span> <span class="text-muted small">since last month</span>
                </div>
            </div>
            <div class="progress" style="height: 4px; border-radius: 0;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card card-stats bg-white shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted fw-bold text-uppercase mb-0" style="letter-spacing: 1px; font-size: 0.8rem;">Total Products</h6>
                    <div class="icon-stats text-success bg-success bg-opacity-10">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
                <h3 class="fw-bolder mb-0 fs-1"><?= $productsCount ?></h3>
                <div class="mt-3">
                    <span class="text-success small fw-bold"><i class="bi bi-arrow-up-right me-1"></i>+5</span> <span class="text-muted small">new this week</span>
                </div>
            </div>
            <div class="progress" style="height: 4px; border-radius: 0;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 45%"></div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card card-stats bg-white shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted fw-bold text-uppercase mb-0" style="letter-spacing: 1px; font-size: 0.8rem;">Total Orders</h6>
                    <div class="icon-stats text-warning bg-warning bg-opacity-10">
                        <i class="bi bi-cart-check"></i>
                    </div>
                </div>
                <h3 class="fw-bolder mb-0 fs-1"><?= $ordersCount ?></h3>
                <div class="mt-3">
                    <span class="text-danger small fw-bold"><i class="bi bi-arrow-down-right me-1"></i>-2%</span> <span class="text-muted small">since last month</span>
                </div>
            </div>
            <div class="progress" style="height: 4px; border-radius: 0;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%"></div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card card-stats text-white shadow-sm h-100" style="background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-white-50 fw-bold text-uppercase mb-0" style="letter-spacing: 1px; font-size: 0.8rem;">Total Revenue</h6>
                    <div class="icon-stats text-white bg-white bg-opacity-25">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                </div>
                <h3 class="fw-bolder mb-0 fs-1">$<?= number_format($totalRevenue, 2) ?></h3>
                <div class="mt-3">
                    <span class="text-white small fw-bold"><i class="bi bi-arrow-up-right me-1"></i>+24%</span> <span class="text-white-50 small">growth</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Recent Activity</h5>
                <p class="text-muted">The system is running smoothly. To view detailed tables, please use the sidebar navigation.</p>
                <div class="alert alert-info border-0 bg-info bg-opacity-10 d-flex align-items-center mb-0 mt-3">
                    <i class="bi bi-info-circle-fill me-3 fs-4 text-info"></i>
                    <div>
                        <strong>Tip:</strong> You can manage products, upload images, and update order statuses from their respective sections in the left menu.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
