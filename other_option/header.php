<?php require_once __DIR__.'/db.php'; require_once __DIR__.'/functions.php'; ?>
<header class="site-header">
  <div class="header-left">
    <img src="assets/user-logo.png" alt="User" class="user-logo" onclick="location.href='login.php'">
    <div class="logo" onclick="location.href='index.php'">ShopWise</div>
  </div>

  <form class="search-bar" action="products.php" method="get">
    <input type="text" name="search" placeholder="Search products, brands…" value="<?= h($_GET['search'] ?? '') ?>">
    <button type="submit">Search</button>
  </form>

  <nav>
    <a href="index.php">Home</a>
    <a href="products.php">Products</a>
    <a href="cart.php">Cart (<span id="cart-count"><?= cart_count(); ?></span>)</a>
    <?php if(isset($_SESSION['user'])): ?>
      <span class="hello">Hi, <?= h($_SESSION['user']['name']); ?></span>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="login.php">Login</a>
      <a href="signup.php">Sign Up</a>
    <?php endif; ?>
  </nav>
</header>
