<?php
require_once '../../config/db.php';
require_once 'header.php';

$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

$query = "SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE 1=1";
$params = [];

if ($category_filter) {
    $query .= " AND p.category_id = ?";
    $params[] = $category_filter;
}
if ($search_query) {
    $query .= " AND p.name LIKE ?";
    $params[] = '%' . $search_query . '%';
}

$query .= " ORDER BY p.id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll();

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card shadow-sm border-0 mb-4 rounded-4 sticky-top" style="top: 100px;">
                <div class="card-header bg-white fw-bolder fs-5 py-3 border-bottom-0 rounded-top-4">
                    <i class="bi bi-grid me-2 text-primary"></i>Categories
                </div>
                <div class="list-group list-group-flush rounded-bottom-4 px-2 pb-2">
                    <a href="products.php" class="list-group-item list-group-item-action rounded-3 mb-1 border-0 <?= $category_filter == '' ? 'active shadow-sm' : 'text-muted' ?>">
                        <i class="bi bi-asterisk me-2"></i> All Products
                    </a>
                    <?php foreach($categories as $c): ?>
                        <a href="products.php?category=<?= $c['id'] ?>" class="list-group-item list-group-item-action rounded-3 mb-1 border-0 <?= $category_filter == $c['id'] ? 'active shadow-sm' : 'text-muted' ?>">
                            <i class="bi bi-chevron-right me-1" style="font-size: 0.8rem;"></i> <?= htmlspecialchars($c['name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9 col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bolder mb-0">Shop Products</h3>
                <span class="text-muted"><?= count($products) ?> items found</span>
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
                                    <button type="submit" class="btn btn-primary rounded-circle shadow" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; transition: 0.3s;" title="Add to Cart">
                                        <i class="bi bi-cart-plus fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <?php if(empty($products)): ?>
                    <div class="col-12 w-100">
                        <div class="alert alert-light text-center p-5 border rounded-4 shadow-sm">
                            <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
                            <h4 class="fw-bold">No products found</h4>
                            <p class="text-muted">Try adjusting your filters or search query.</p>
                            <a href="products.php" class="btn btn-primary mt-2">Clear Filters</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
