<?php require_once 'db.php'; require_once 'functions.php';

$search = trim($_GET['search'] ?? '');
$category = trim($_GET['category'] ?? '');
$sql = "SELECT * FROM products WHERE 1";
$params = [];
if($search !== ''){
  $s = $conn->real_escape_string($search);
  $sql .= " AND (name LIKE '%$s%' OR category LIKE '%$s%')";
}
if($category !== ''){
  $c = $conn->real_escape_string($category);
  $sql .= " AND category = '$c'";
}
$sql .= " ORDER BY id DESC";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products • ShopWise</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-pattern">
  <?php include 'header.php'; ?>
  <main>
    <h1 class="page-title">Products <?= $search ? '— “'.h($search).'”' : '' ?></h1>

    <div class="filters">
      <a class="chip <?= $category==''?'active':'' ?>" href="products.php">All</a>
      <?php
        $cats = $conn->query("SELECT DISTINCT category FROM products ORDER BY category");
        while($row=$cats->fetch_row()): $cat=$row[0]; ?>
        <a class="chip <?= $category==$cat?'active':'' ?>" href="products.php?category=<?= urlencode($cat) ?>"><?= h($cat) ?></a>
      <?php endwhile; ?>
    </div>

    <div class="product-grid">
      <?php while($p = $res->fetch_assoc()): ?>
        <article class="product-card">
          <img src="<?= h($p['image']) ?>" alt="<?= h($p['name']) ?>">
          <h3><?= h($p['name']) ?></h3>
          <p class="price">₹<?= number_format($p['price'],0) ?></p>
          <p class="desc"><?= h($p['short_desc']) ?></p>
          <div class="card-actions">
            <a class="btn ghost" href="product.php?id=<?= $p['id'] ?>">View</a>
            <form action="add_to_cart.php" method="post">
              <input type="hidden" name="id" value="<?= $p['id'] ?>">
              <button class="btn" type="submit">Add to Cart</button>
            </form>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
  </main>
  <footer><p>© <?= date('Y'); ?> ShopWise</p></footer>
</body>
</html>
