<?php require_once 'db.php';
$msg = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email = trim($_POST['email'] ?? ''); $pass = $_POST['password'] ?? '';
  if($email && $pass){
    $stmt = $conn->prepare("SELECT id,name,email,password_hash FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param('s',$email); $stmt->execute(); $u = $stmt->get_result()->fetch_assoc();
    if($u && password_verify($pass, $u['password_hash'])){ $_SESSION['user']=$u; header('Location: index.php'); exit; }
    $msg = 'Invalid email/password';
  } else { $msg = 'Please fill all fields.'; }
}
?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login • ShopWise</title><link rel="stylesheet" href="style.css"></head>
<body class="bg-auth">
<?php include 'header.php'; ?>
<main class="auth-wrap">
  <form class="card auth" method="post">
    <h2>Login</h2>
    <?php if($msg): ?><div class="alert"><?= h($msg) ?></div><?php endif; ?>
    <label>Email</label><input type="email" name="email" required>
    <label>Password</label><input type="password" name="password" required>
    <button class="btn" type="submit">Login</button>
    <p class="muted">New here? <a href="signup.php">Create an account</a></p>
  </form>
</main>
<footer><p>© <?= date('Y'); ?> ShopWise</p></footer>
</body></html>
