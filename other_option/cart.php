<?php require_once 'db.php'; require_once 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart • ShopWise</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-pattern">
  <?php include 'header.php'; ?>
  <main>
    <h1 class="page-title">Your Cart</h1>

    <?php if(!$_SESSION['cart']): ?>
      <p>Your cart is empty. <a href="products.php">Browse products</a></p>
    <?php else:
      $ids = implode(',', array_map('intval', array_keys($_SESSION['cart'])));
      $res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
      $total = 0; ?>
      <table class="cart-table">
        <thead><tr>
          <th>Product</th><th>Name</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th>
        </tr></thead>
        <tbody>
        <?php while($p=$res->fetch_assoc()):
          $qty = $_SESSION['cart'][$p['id']];
          $sub = $qty * $p['price']; $total += $sub; ?>
          <tr>
            <td><img class="thumb" src="<?= h($p['image']) ?>" alt=""></td>
            <td><a href="product.php?id=<?= $p['id'] ?>"><?= h($p['name']) ?></a></td>
            <td>₹<?= number_format($p['price'],0) ?></td>
            <td>
              <form action="add_to_cart.php" method="post" class="inline">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <input type="number" name="qty" value="<?= $qty ?>" min="1">
                <button class="btn xs" type="submit">Update</button>
              </form>
            </td>
            <td>₹<?= number_format($sub,0) ?></td>
            <td><a class="link-danger" href="remove.php?id=<?= $p['id'] ?>">Remove</a></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
      <div class="cart-total">
        <div>Total: <strong>₹<?= number_format($total,0) ?></strong></div>
        <a class="btn" href="checkout.php">Checkout</a>
      </div>
    <?php endif; ?>
  </main>
  <footer><p>© <?= date('Y'); ?> ShopWise</p></footer>
</body>
</html>
