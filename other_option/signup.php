<?php require_once 'db.php';
$msg = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $pass = $_POST['password'] ?? '';
  if($name && $email && $pass){
    $stmt = $conn->prepare("INSERT INTO users(name,email,password_hash) VALUES (?,?,?)");
    $hash = password_hash($pass, PASSWORD_BCRYPT);
    $stmt->bind_param('sss', $name, $email, $hash);
    if($stmt->execute()){ $_SESSION['user']=['id'=>$conn->insert_id,'name'=>$name,'email'=>$email]; header('Location: index.php'); exit; }
    $msg = 'Email already registered.';
  } else { $msg = 'Please fill all fields.'; }
}
?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up • ShopWise</title><link rel="stylesheet" href="style.css"></head>
<body class="bg-auth">
<?php include 'header.php'; ?>
<main class="auth-wrap">
  <form class="card auth" method="post">
    <h2>Create Account</h2>
    <?php if($msg): ?><div class="alert"><?= h($msg) ?></div><?php endif; ?>
    <label>Name</label><input name="name" required>
    <label>Email</label><input type="email" name="email" required>
    <label>Password</label><input type="password" name="password" required minlength="6">
    <button class="btn" type="submit">Sign Up</button>
    <p class="muted">Already have an account? <a href="login.php">Login</a></p>
  </form>
</main>
<footer><p>© <?= date('Y'); ?> ShopWise</p></footer>
</body></html>
