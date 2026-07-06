<?php
require_once '../../../config/db.php';
require_once '../header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update_status') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
}

$orders = $pdo->query("
    SELECT o.*, u.full_name as user_name 
    FROM orders o 
    JOIN users u ON o.user_id = u.id 
    ORDER BY o.created_at DESC
")->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Orders</h2>
</div>

<table class="table table-bordered bg-white shadow-sm">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($orders as $o): ?>
        <tr>
            <td>#<?= $o['id'] ?></td>
            <td><?= htmlspecialchars($o['user_name']) ?></td>
            <td>$<?= number_format($o['total_amount'], 2) ?></td>
            <td>
                <span class="badge bg-<?= $o['status'] == 'Completed' ? 'success' : ($o['status'] == 'Cancelled' ? 'danger' : ($o['status'] == 'Pending' ? 'warning' : 'info')) ?>">
                    <?= $o['status'] ?>
                </span>
            </td>
            <td><?= $o['created_at'] ?></td>
            <td>
                <form method="POST" class="d-flex align-items-center">
                    <input type="hidden" name="action" value="update_status">
                    <input type="hidden" name="id" value="<?= $o['id'] ?>">
                    <select name="status" class="form-select form-select-sm me-2" style="width: auto;">
                        <option value="Pending" <?= $o['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Processing" <?= $o['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                        <option value="Completed" <?= $o['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="Cancelled" <?= $o['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../footer.php'; ?>
