<?php
require_once '../../../config/db.php';
require_once '../header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $category_id = $_POST['category_id'];
        
        $imageName = 'default.png';
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], '../../../assets/Products/' . $imageName);
        }

        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, stock, category_id, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $stock, $category_id, $imageName]);

    } elseif ($_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }
}

$products = $pdo->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id")->fetchAll();
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Products</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Product</button>
</div>

<table class="table table-bordered bg-white shadow-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><img src="../../../assets/Products/<?= $p['image'] ?>" width="50" alt="<?= htmlspecialchars($p['name']) ?>"></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['category_name']) ?></td>
            <td>$<?= number_format($p['price'], 2) ?></td>
            <td><?= $p['stock'] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="action" value="add">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-select" required>
                        <?php foreach($categories as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../footer.php'; ?>
