<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Abed Store</title>
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
        .register-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .register-image {
            background: linear-gradient(135deg, rgba(25,135,84,0.9) 0%, rgba(32,201,151,0.9) 100%), url('https://images.unsplash.com/photo-1550009158-9ebf69173e03?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80') center/cover;
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
            box-shadow: 0 0 0 0.25rem rgba(25,135,84,0.15);
            border-color: #198754;
        }
        .btn-success {
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #198754 0%, #157347 100%);
            border: none;
        }
        .btn-success:hover {
            box-shadow: 0 8px 20px rgba(25,135,84,0.3);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card register-card">
                <div class="row g-0 flex-row-reverse">
                    <div class="col-md-5 d-none d-md-block">
                        <div class="register-image">
                            <i class="bi bi-shield-check mb-3" style="font-size: 3rem;"></i>
                            <h2 class="fw-bolder mb-3">Join Us!</h2>
                            <p class="opacity-75">Create an account to start shopping our premium collection of electronics today.</p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body p-5">
                            <div class="text-center mb-4 d-md-none">
                                <i class="bi bi-lightning-charge-fill text-warning" style="font-size: 2rem;"></i>
                                <h3 class="fw-bolder mt-2">Abed Store</h3>
                            </div>
                            
                            <h3 class="fw-bold mb-1">Create an Account</h3>
                            <p class="text-muted mb-4">Please fill in the details below to register.</p>
                            
                            <?php 
                            if(isset($_SESSION['error'])) {
                                echo '<div class="alert alert-danger border-0 shadow-sm rounded-3"><i class="bi bi-exclamation-circle-fill me-2"></i>'.$_SESSION['error'].'</div>';
                                unset($_SESSION['error']);
                            }
                            ?>
                            
                            <form action="../../services/Auth/register_check.php" method="POST">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="John Doe" required>
                                    <label for="full_name" class="text-muted"><i class="bi bi-person me-2"></i>Full Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Username" required>
                                    <label for="email" class="text-muted"><i class="bi bi-person me-2"></i>Username</label>
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                            <label for="password" class="text-muted"><i class="bi bi-lock me-2"></i>Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm" required>
                                            <label for="confirm_password" class="text-muted"><i class="bi bi-lock-fill me-2"></i>Confirm</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label text-muted small" for="terms">
                                        I agree to the <a href="#" class="text-success text-decoration-none fw-medium">Terms of Service</a> & <a href="#" class="text-success text-decoration-none fw-medium">Privacy Policy</a>
                                    </label>
                                </div>
                                
                                <button type="submit" class="btn btn-success w-100 mb-4 shadow-sm">Create Account</button>
                            </form>
                            
                            <div class="text-center">
                                <p class="text-muted small mb-2">Already have an account? <a href="login.php" class="text-success text-decoration-none fw-bold">Sign in here</a></p>
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
