<?php
require_once '../../../config/db.php';
require_once '../header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        if (!empty($name)) {
            $stmt = $pdo->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
            $stmt->execute([$name, $description]);
        }
    } elseif ($_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Categories</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Category</button>
</div>

<table class="table table-bordered bg-white shadow-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $cat): ?>
        <tr>
            <td><?= $cat['id'] ?></td>
            <td><?= htmlspecialchars($cat['name']) ?></td>
            <td><?= htmlspecialchars($cat['description']) ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $cat['id'] ?>">
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
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="action" value="add">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../footer.php'; ?>
