<?php 
require_once 'includes/db.php';
$error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    if(empty($name) || empty($email) || empty($pass)) {
        $error = 'All fields are required.';
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hash]);
            header("Location: login.php");
            exit;
        } catch(PDOException $e) {
            $error = 'Email already exists or database error.';
        }
    }
}
?>
<?php require_once 'includes/header.php'; ?>

<section class="container" style="padding: 100px 0; min-height:80vh; display:flex; align-items:center; justify-content:center;">
    <div class="card" style="width:100%; max-width:400px;">
        <h2 style="text-align:center; margin-bottom:30px; font-size:28px;">Become a <span class="highlight">Member</span></h2>
        
        <?php if($error): ?>
            <div style="background:rgba(255,0,0,0.1); color:#ff3333; padding:10px; border-radius:8px; margin-bottom:20px; text-align:center; border:1px solid #ff3333;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div style="margin-bottom:20px;">
                <label style="font-size:14px; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted);">Full Name</label>
                <input type="text" name="name" required style="width:100%; padding:15px; margin-top:8px; background:rgba(0,0,0,0.3); color:#fff; border:1px solid var(--border); border-radius:8px; font-family:'Outfit', sans-serif;">
            </div>
            <div style="margin-bottom:20px;">
                <label style="font-size:14px; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted);">Email</label>
                <input type="email" name="email" required style="width:100%; padding:15px; margin-top:8px; background:rgba(0,0,0,0.3); color:#fff; border:1px solid var(--border); border-radius:8px; font-family:'Outfit', sans-serif;">
            </div>
            <div style="margin-bottom:30px;">
                <label style="font-size:14px; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted);">Password</label>
                <input type="password" name="password" required style="width:100%; padding:15px; margin-top:8px; background:rgba(0,0,0,0.3); color:#fff; border:1px solid var(--border); border-radius:8px; font-family:'Outfit', sans-serif;">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;">Create Account</button>
        </form>
        <p style="text-align:center; margin-top:20px; font-size:14px; color:var(--text-muted);">Already a member? <a href="/Gym/login.php" style="color:var(--secondary);">Login</a></p>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
