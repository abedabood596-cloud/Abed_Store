<?php
require_once '../../config/db.php';
if(session_status() == PHP_SESSION_NONE){ session_start(); }

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $product_id = $_POST['product_id'];
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]++;
        } else {
            $_SESSION['cart'][$product_id] = 1;
        }
        header("Location: cart.php");
        exit;
    } elseif ($_POST['action'] == 'remove') {
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);
        header("Location: cart.php");
        exit;
    } elseif ($_POST['action'] == 'update') {
        $product_id = $_POST['product_id'];
        $qty = (int)$_POST['quantity'];
        if ($qty > 0) {
            $_SESSION['cart'][$product_id] = $qty;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
        header("Location: cart.php");
        exit;
    }
}

require_once 'header.php';

$cart_items = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    while ($row = $stmt->fetch()) {
        $qty = $_SESSION['cart'][$row['id']];
        $row['cart_qty'] = $qty;
        $row['subtotal'] = $qty * $row['price'];
        $total += $row['subtotal'];
        $cart_items[] = $row;
    }
}
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-3">
        <h2 class="fw-bolder mb-0"><i class="bi bi-cart3 me-2 text-primary"></i>Shopping Cart</h2>
        <span class="text-muted fw-medium"><?= count($cart_items) ?> Items</span>
    </div>

    <?php if(empty($cart_items)): ?>
        <div class="alert bg-white shadow-sm border-0 text-center p-5 rounded-4 mt-4">
            <i class="bi bi-cart-x text-muted mb-3" style="font-size: 4rem;"></i>
            <h4 class="fw-bold">Your cart is empty</h4>
            <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
            <a href="products.php" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm">Continue Shopping</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4 py-3 text-uppercase text-muted" style="font-size: 0.8rem; letter-spacing: 1px;">Product Details</th>
                                        <th class="py-3 text-uppercase text-muted text-center" style="font-size: 0.8rem; letter-spacing: 1px;">Quantity</th>
                                        <th class="py-3 text-uppercase text-muted text-end" style="font-size: 0.8rem; letter-spacing: 1px;">Price</th>
                                        <th class="py-3 text-uppercase text-muted text-end" style="font-size: 0.8rem; letter-spacing: 1px;">Total</th>
                                        <th class="pe-4 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cart_items as $item): ?>
                                    <tr>
                                        <td class="ps-4 py-4">
                                            <div class="d-flex align-items-center">
                                                <img src="../../assets/Products/<?= $item['image'] ?>" width="80" class="me-4 rounded-3 p-2 bg-light border" alt="...">
                                                <div>
                                                    <h6 class="fw-bold mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                                                    <small class="text-muted d-block mb-2">Category ID: <?= $item['category_id'] ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4" style="width: 150px;">
                                            <form method="POST" class="d-flex justify-content-center">
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                                <div class="input-group input-group-sm w-75 shadow-sm rounded-pill overflow-hidden border">
                                                    <input type="number" name="quantity" value="<?= $item['cart_qty'] ?>" class="form-control text-center border-0 fw-bold" min="1">
                                                    <button type="submit" class="btn btn-light border-0"><i class="bi bi-arrow-clockwise"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="py-4 text-end fw-medium text-muted">
                                            $<?= number_format($item['price'], 2) ?>
                                        </td>
                                        <td class="py-4 text-end fw-bold text-dark fs-6">
                                            $<?= number_format($item['subtotal'], 2) ?>
                                        </td>
                                        <td class="pe-4 py-4 text-end">
                                            <form method="POST">
                                                <input type="hidden" name="action" value="remove">
                                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle" style="width: 35px; height: 35px;" title="Remove Item"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="products.php" class="text-decoration-none fw-medium text-primary"><i class="bi bi-arrow-left me-2"></i>Continue Shopping</a>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bolder border-bottom pb-3 mb-4">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Subtotal</span>
                            <span class="fw-medium text-dark">$<?= number_format($total, 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Shipping</span>
                            <span class="text-success fw-medium">Free</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 text-muted">
                            <span>Tax</span>
                            <span class="fw-medium text-dark">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 pt-3 border-top">
                            <span class="fs-5 fw-bold">Total</span>
                            <span class="fs-4 fw-black text-primary" style="font-weight: 800;">$<?= number_format($total, 2) ?></span>
                        </div>
                        <form action="../../services/Orders/place_order.php" method="POST">
                            <input type="hidden" name="total_amount" value="<?= $total ?>">
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <button type="submit" class="btn btn-primary w-100 fw-bold btn-lg rounded-pill shadow">Proceed to Checkout</button>
                            <?php else: ?>
                                <a href="../Auth/login.php" class="btn btn-dark w-100 fw-bold btn-lg rounded-pill shadow">Login to Checkout</a>
                            <?php endif; ?>
                        </form>
                        <div class="mt-4 text-center">
                            <i class="bi bi-shield-lock text-success me-1"></i> <small class="text-muted">Secure Checkout</small>
                            <div class="mt-2">
                                <i class="bi bi-credit-card mx-1 text-muted fs-4"></i>
                                <i class="bi bi-paypal mx-1 text-muted fs-4"></i>
                                <i class="bi bi-apple mx-1 text-muted fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>
