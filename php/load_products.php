<?php
header("Content-Type: text/html; charset=UTF-8");
include "config/load_db.php"; // adjust path as needed

$pg = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
$sort = $_GET['sort'] ?? 'none';
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
$brand_id = isset($_GET['brand_id']) ? intval($_GET['brand_id']) : 0;

$items_per_page = 3;
$offset = ($pg - 1) * $items_per_page;

$order_by = "";
if ($sort == "name") $order_by = "ORDER BY name ASC";
elseif ($sort == "price") $order_by = "ORDER BY price ASC";

$filters = [];
if ($category_id > 0) $filters[] = "p.category_id = $category_id";
if ($brand_id > 0) $filters[] = "p.brand_id = $brand_id";

$where_sql = '';
if (!empty($filters)) {
    $where_sql = "WHERE " . implode(' AND ', $filters);
}

$sql = "
    SELECT p.*, c.name AS category_name, b.name AS brand_name, b.image AS brand_image, b.id AS brand_id
    FROM product p
    JOIN category c ON p.category_id = c.id
    JOIN brand b ON p.brand_id = b.id
    $where_sql
    $order_by
    LIMIT $items_per_page OFFSET $offset
";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()):
?>
    <div class="col-sm-6 col-lg-4">
        <div class="product-card">
            <a href="index.php?page=product_desc&id=<?= $row['id'] ?>">
                <img src="<?= htmlspecialchars($row['image']) ?>" class="product-image" alt="<?= htmlspecialchars($row['name']) ?>" style="object-fit: cover;">
            </a>
            <div class="card-body text-center">
                <h5 class="card-title">
                    <a href="index.php?page=product_desc&id=<?= $row['id'] ?>" class="text-decoration-none text-dark" style="font-size: 25px;">
                        <?= htmlspecialchars($row['name']) ?>
                    </a>
                </h5>
                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                    <a href="index.php?page=product&brand_id=<?= $row['brand_id'] ?>" class="text-decoration-none d-flex align-items-center gap-2">
                        <img src="<?= htmlspecialchars($row['brand_image']) ?>" alt="<?= htmlspecialchars($row['brand_name']) ?>" style="height: 30px; object-fit: contain;">
                        <span class="text-muted"><?= htmlspecialchars($row['brand_name']) ?></span>
                    </a>
                </div>
                <p class="fw-bold text-success"><?= htmlspecialchars($row['price']) ?> yen</p>
            </div>
        </div>
    </div>
<?php endwhile; ?>
