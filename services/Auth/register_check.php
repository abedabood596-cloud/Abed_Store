<?php
session_start();
require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = 'Please fill in all fields.';
        header('Location: ../../views/Auth/register.php');
        exit;
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: ../../views/Auth/register.php');
        exit;
    }

    // Check if email exists
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = 'Email already registered.';
        header('Location: ../../views/Auth/register.php');
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Default role for new registration is Customer (role_id = 2)
    $stmt = $pdo->prepare('INSERT INTO users (full_name, email, password, role_id) VALUES (?, ?, ?, 2)');
    
    if ($stmt->execute([$full_name, $email, $hashed_password])) {
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['full_name'] = $full_name;
        $_SESSION['role_id'] = 2; // Customer

        header('Location: ../../views/Customer/index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Registration failed. Please try again.';
        header('Location: ../../views/Auth/register.php');
        exit;
    }
} else {
    header('Location: ../../views/Auth/register.php');
    exit;
}
?>
