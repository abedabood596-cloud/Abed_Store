<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Abed Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f4f6f9 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .login-image {
            background: linear-gradient(135deg, rgba(13,110,253,0.9) 0%, rgba(102,16,242,0.9) 100%), url('https://images.unsplash.com/photo-1498049794561-7780e7231661?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80') center/cover;
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 3rem;
            text-align: center;
        }
        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.15);
        }
        .btn-primary {
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border: none;
        }
        .btn-primary:hover {
            box-shadow: 0 8px 20px rgba(13,110,253,0.3);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card login-card">
                <div class="row g-0">
                    <div class="col-md-6 d-none d-md-block">
                        <div class="login-image">
                            <i class="bi bi-lightning-charge-fill text-warning mb-3" style="font-size: 3rem;"></i>
                            <h2 class="fw-bolder mb-3">Welcome Back!</h2>
                            <p class="opacity-75">Sign in to access your orders, track shipments, and discover new electronics.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body p-5">
                            <div class="text-center mb-4 d-md-none">
                                <i class="bi bi-lightning-charge-fill text-warning" style="font-size: 2rem;"></i>
                                <h3 class="fw-bolder mt-2">Abed Store</h3>
                            </div>
                            
                            <h3 class="fw-bold mb-1">Sign In</h3>
                            <p class="text-muted mb-4">Please enter your credentials to login.</p>
                            
                            <?php 
                            if(isset($_SESSION['error'])) {
                                echo '<div class="alert alert-danger border-0 shadow-sm rounded-3"><i class="bi bi-exclamation-circle-fill me-2"></i>'.$_SESSION['error'].'</div>';
                                unset($_SESSION['error']);
                            }
                            ?>
                            
                            <form action="../../services/Auth/login_check.php" method="POST">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Username" required>
                                    <label for="email" class="text-muted"><i class="bi bi-person me-2"></i>Username</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password" class="text-muted"><i class="bi bi-lock me-2"></i>Password</label>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                        <label class="form-check-label text-muted small" for="rememberMe">Remember me</label>
                                    </div>
                                    <a href="#" class="text-primary text-decoration-none small fw-medium">Forgot password?</a>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100 mb-4 shadow-sm">Login</button>
                            </form>
                            
                            <div class="text-center">
                                <p class="text-muted small mb-2">Don't have an account? <a href="register.php" class="text-primary text-decoration-none fw-bold">Register here</a></p>
                                <a href="../../views/Customer/index.php" class="text-secondary text-decoration-none small"><i class="bi bi-arrow-left me-1"></i>Back to Store</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
