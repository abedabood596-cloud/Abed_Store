<?php
require_once '../../config/db.php';
require_once 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$orders = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$orders->execute([$user_id]);
$orders = $orders->fetchAll();
?>

<div class="container my-5">
    <h2 class="mb-4 fw-bold"><i class="bi bi-box-seam me-2 text-primary"></i>My Orders</h2>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success shadow-sm rounded-3"><i class="bi bi-check-circle-fill me-2"></i>Order placed successfully!</div>
    <?php endif; ?>

    <?php if(empty($orders)): ?>
        <div class="alert alert-info shadow-sm rounded-3"><i class="bi bi-info-circle-fill me-2"></i>You have no orders yet. <a href="products.php" class="alert-link">Start shopping</a></div>
    <?php else: ?>
        <div class="table-responsive rounded-4 shadow-sm border">
            <table class="table table-hover align-middle bg-white mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3">Order ID</th>
                        <th class="py-3">Total Amount</th>
                        <th class="py-3">Status</th>
                        <th class="pe-4 py-3 text-end">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $o): ?>
                    <tr>
                        <td class="ps-4 py-3 fw-bold text-muted">#<?= $o['id'] ?></td>
                        <td class="py-3 fw-medium">$<?= number_format($o['total_amount'], 2) ?></td>
                        <td class="py-3">
                            <span class="badge rounded-pill px-3 py-2 bg-<?= $o['status'] == 'Completed' ? 'success' : ($o['status'] == 'Cancelled' ? 'danger' : ($o['status'] == 'Pending' ? 'warning' : 'info')) ?>">
                                <?= $o['status'] ?>
                            </span>
                        </td>
                        <td class="pe-4 py-3 text-end text-muted small"><?= date('F j, Y g:i A', strtotime($o['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>
