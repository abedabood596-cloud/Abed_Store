<?php
require_once '../../config/db.php';
require_once 'header.php';

// Fetch some latest products for the homepage
$stmt = $pdo->query("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC LIMIT 6");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
.text-shadow { text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
.carousel-item::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
    z-index: 1;
}
.hero-caption { z-index: 2; }
</style>

<!-- Hero Carousel -->
<div class="container mt-4 mb-5">
<div id="heroCarousel" class="carousel slide hero-carousel shadow-lg" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../../assets/Products/macbook.png" class="d-block w-100" style="object-fit: cover; background: #e9ecef;" alt="...">
            <div class="carousel-caption hero-caption d-none d-md-block text-start">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2 fs-6 rounded-pill shadow-sm">New Arrival</span>
                <h1 class="display-3 fw-bolder text-white text-shadow mb-3">MacBook Pro 14"</h1>
                <p class="fs-4 text-light opacity-100 text-shadow mb-4">Supercharged by M2 Pro and M2 Max. Pro everywhere.</p>
                <a href="products.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">Shop Now <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../../assets/Products/iphone.png" class="d-block w-100" style="object-fit: cover; background: #e9ecef;" alt="...">
            <div class="carousel-caption hero-caption d-none d-md-block text-start">
                <span class="badge bg-danger mb-3 px-3 py-2 fs-6 rounded-pill shadow-sm">Hot Deal</span>
                <h1 class="display-3 fw-bolder text-white text-shadow mb-3">iPhone 15 Pro</h1>
                <p class="fs-4 text-light opacity-100 text-shadow mb-4">Titanium. So strong. So light. So Pro.</p>
                <a href="products.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">Explore <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../../assets/Products/airpods.png" class="d-block w-100" style="object-fit: cover; background: #e9ecef;" alt="...">
            <div class="carousel-caption hero-caption d-none d-md-block text-start">
                <span class="badge bg-success mb-3 px-3 py-2 fs-6 rounded-pill shadow-sm">Top Rated</span>
                <h1 class="display-3 fw-bolder text-white text-shadow mb-3">AirPods Pro</h1>
                <p class="fs-4 text-light opacity-100 text-shadow mb-4">Magic like you've never heard.</p>
                <a href="products.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow">Listen Now <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="z-index: 5;">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 3rem; height: 3rem;"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="z-index: 5;">
        <span class="carousel-control-next-icon" aria-hidden="true" style="width: 3rem; height: 3rem;"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</div>

<!-- Features Section -->
<div class="container mb-5 bg-white rounded-4 shadow-sm p-4 border" style="border-color: rgba(0,0,0,0.05)!important;">
    <div class="row g-4 py-3 row-cols-1 row-cols-lg-3">
      <div class="col d-flex align-items-center">
        <div class="icon-square d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-4 feature-icon mb-0 shadow-sm">
          <i class="bi bi-truck"></i>
        </div>
        <div>
          <h3 class="fs-5 fw-bold mb-1">Free Shipping</h3>
          <p class="text-muted small mb-0">On all orders over $500</p>
        </div>
      </div>
      <div class="col d-flex align-items-center border-start border-end d-none d-lg-flex px-4">
        <div class="icon-square d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-4 feature-icon mb-0 shadow-sm" style="background-color: rgba(25,135,84,0.1); color: #198754;">
          <i class="bi bi-shield-check"></i>
        </div>
        <div>
          <h3 class="fs-5 fw-bold mb-1">Secure Payment</h3>
          <p class="text-muted small mb-0">100% secure checkout</p>
        </div>
      </div>
      <div class="col d-flex align-items-center ps-lg-4">
        <div class="icon-square d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-4 feature-icon mb-0 shadow-sm" style="background-color: rgba(220,53,69,0.1); color: #dc3545;">
          <i class="bi bi-headset"></i>
        </div>
        <div>
          <h3 class="fs-5 fw-bold mb-1">24/7 Support</h3>
          <p class="text-muted small mb-0">Dedicated support team</p>
        </div>
      </div>
    </div>
</div>

<!-- Featured Products Section -->
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-3">
        <h2 class="fw-bolder mb-0">Featured Products</h2>
        <a href="products.php" class="btn btn-outline-primary rounded-pill px-4 fw-medium shadow-sm">View All <i class="bi bi-arrow-right ms-1"></i></a>
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach($products as $p): ?>
            <div class="col">
                <div class="card h-100 product-card shadow-sm border-0 position-relative">
                    <?php if($p['stock'] < 15): ?>
                        <span class="position-absolute top-0 start-0 badge bg-danger m-3 z-3 px-3 py-2 rounded-pill shadow-sm"><i class="bi bi-fire me-1"></i>Low Stock</span>
                    <?php endif; ?>
                    <img src="../../assets/Products/<?= $p['image'] ?>" class="card-img-top p-4" alt="<?= htmlspecialchars($p['name']) ?>">
                    <div class="card-body d-flex flex-column bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="text-primary fw-bolder text-uppercase" style="letter-spacing: 1.5px; font-size: 0.7rem;"><?= htmlspecialchars($p['category_name']) ?></small>
                            <div class="text-warning small">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                            </div>
                        </div>
                        <h5 class="card-title fw-bold mb-3 fs-5"><?= htmlspecialchars($p['name']) ?></h5>
                        <p class="card-text text-muted small flex-grow-1 lh-lg"><?= htmlspecialchars(substr($p['description'], 0, 80)) ?>...</p>
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                            <span class="fs-4 fw-black text-dark" style="font-weight: 800;">$<?= number_format($p['price'], 2) ?></span>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                                <button type="submit" class="btn btn-primary rounded-circle shadow" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; transition: 0.3s;">
                                    <i class="bi bi-cart-plus fs-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>
