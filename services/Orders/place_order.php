<?php
session_start();
require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && !empty($_SESSION['cart'])) {
    $user_id = $_SESSION['user_id'];
    $total_amount = $_POST['total_amount'];

    try {
        $pdo->beginTransaction();

        // 1. Create Order
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
        $stmt->execute([$user_id, $total_amount]);
        $order_id = $pdo->lastInsertId();

        // 2. Insert Order Details & Update Stock
        $stmt_details = $pdo->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt_stock = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");

        $ids = implode(',', array_keys($_SESSION['cart']));
        $products = $pdo->query("SELECT id, price FROM products WHERE id IN ($ids)")->fetchAll(PDO::FETCH_ASSOC);

        $product_prices = [];
        foreach($products as $p) {
            $product_prices[$p['id']] = $p['price'];
        }

        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $price = $product_prices[$product_id];
            $stmt_details->execute([$order_id, $product_id, $quantity, $price]);
            $stmt_stock->execute([$quantity, $product_id]);
        }

        $pdo->commit();
        
        // Clear Cart
        unset($_SESSION['cart']);

        header("Location: ../../views/Customer/orders.php?success=1");
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        die("Error placing order: " . $e->getMessage());
    }
} else {
    header("Location: ../../views/Customer/cart.php");
    exit;
}
?>
