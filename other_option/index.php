<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShopWise • Smart Shopping</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-home">
  <!-- Splash/Intro overlay -->
  <div id="splash">
    <div class="splash-inner">
      <img src="assets/logo-white.svg" alt="ShopWise">
      <h1>ShopWise</h1>
      <p>Lightweight Web-Based Shopping with Smart Recommendations</p>
      <button id="enterBtn">Enter Store</button>
    </div>
  </div>

  <?php include 'header.php'; ?>

  <main>
    <section class="hero">
      <div class="hero-copy">
        <h1>Welcome to <span>ShopWise</span></h1>
        <p>Personalized recommendations powered by your browsing & purchase activity.</p>
        <a class="btn" href="products.php">Shop Now</a>
      </div>
    </section>

    <section class="products-section">
      <h2>Featured Products</h2>
      <div class="product-grid">
        <?php
          $res = $conn->query("SELECT * FROM products WHERE featured=1 LIMIT 6");
          while($p = $res->fetch_assoc()):
        ?>
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
    </section>

    <section class="banner">
      <div class="banner-inner">
        <h3>Hot this week</h3>
        <p>Grab exclusive deals across Audio • Wearables • Accessories</p>
        <a class="btn white" href="products.php?category=Accessories">Explore Accessories</a>
      </div>
    </section>
  </main>

  <footer><p>© <?= date('Y'); ?> ShopWise. All rights reserved.</p></footer>

  <script>
    // splash
    const s = document.getElementById('splash'), b = document.getElementById('enterBtn');
    if(localStorage.getItem('seenSplash')==='1'){ s.style.display='none'; }
    b.addEventListener('click', ()=>{ s.classList.add('fade'); localStorage.setItem('seenSplash','1'); });

    // update cart badge from server-side rendered count if needed later
  </script>
</body>
</html>
