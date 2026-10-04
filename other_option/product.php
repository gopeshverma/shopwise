<?php require_once 'db.php'; require_once 'functions.php';
$id = (int)($_GET['id'] ?? 0);
$p = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
if(!$p){ header('Location: products.php'); exit; }
$rel = $conn->query("SELECT * FROM products WHERE category='".$conn->real_escape_string($p['category'])."' AND id<>$id LIMIT 4");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= h($p['name']) ?> • ShopWise</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <main class="product-page">
    <div class="product-hero">
      <img src="<?= h($p['image']) ?>" alt="<?= h($p['name']) ?>">
      <div class="details">
        <h1><?= h($p['name']) ?></h1>
        <p class="price">₹<?= number_format($p['price'],0) ?></p>
        <p><?= h($p['short_desc']) ?></p>
        <form action="add_to_cart.php" method="post" class="qty-row">
          <input type="hidden" name="id" value="<?= $p['id'] ?>">
          <label>Qty</label>
          <input type="number" name="qty" value="1" min="1">
          <button class="btn" type="submit">Add to Cart</button>
        </form>
      </div>
    </div>

    <section class="products-section">
      <h2>Related in <?= h($p['category']) ?></h2>
      <div class="product-grid">
        <?php while($r=$rel->fetch_assoc()): ?>
          <article class="product-card small">
            <img src="<?= h($r['image']) ?>" alt="<?= h($r['name']) ?>">
            <h3><?= h($r['name']) ?></h3>
            <p class="price">₹<?= number_format($r['price'],0) ?></p>
            <a class="btn ghost" href="product.php?id=<?= $r['id'] ?>">View</a>
          </article>
        <?php endwhile; ?>
      </div>
    </section>
  </main>
  <footer><p>© <?= date('Y'); ?> ShopWise</p></footer>
</body>
</html>
