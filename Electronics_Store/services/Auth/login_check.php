<?php
session_start();
require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please fill in all fields.';
        header('Location: ../../views/Auth/login.php');
        exit;
    }

    $stmt = $pdo->prepare('SELECT id, full_name, password, role_id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role_id'] = $user['role_id'];

        if ($user['role_id'] == 1) { // Admin
            header('Location: ../../views/Admin/Dashboard.php');
        } else { // Customer
            header('Location: ../../views/Customer/index.php');
        }
        exit;
    } else {
        $_SESSION['error'] = 'Invalid email or password.';
        header('Location: ../../views/Auth/login.php');
        exit;
    }
} else {
    header('Location: ../../views/Auth/login.php');
    exit;
}
?>
