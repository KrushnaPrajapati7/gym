<?php 
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['cart'] = [];
    $success = true;
}
require_once 'includes/header.php'; 
?>

<section class="container" style="padding: 100px 0; min-height:80vh; display:flex; align-items:center; justify-content:center;">
    <div class="card" style="width:100%; max-width:500px;">
        <?php if(isset($success)): ?>
            <h2 style="text-align:center; color:var(--primary); margin-bottom:20px;">Order Confirmed!</h2>
            <p style="text-align:center; color:var(--text-muted); margin-bottom:30px;">Thank you for your purchase. Your supplements are being prepared.</p>
            <a href="/Gym/shop.php" class="btn btn-outline" style="display:block; text-align:center;">Return to Shop</a>
        <?php else: ?>
            <h2 style="text-align:center; margin-bottom:30px;">Secure <span class="highlight">Checkout</span></h2>
            <form method="POST">
                <div style="margin-bottom:20px;">
                    <label style="font-size:14px; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted);">Card Number</label>
                    <input type="text" required placeholder="XXXX XXXX XXXX XXXX" style="width:100%; padding:15px; margin-top:8px; background:rgba(0,0,0,0.3); color:#fff; border:1px solid var(--border); border-radius:8px; font-family:'Outfit', sans-serif;">
                </div>
                <div style="display:flex; gap:20px; margin-bottom:30px;">
                    <div style="flex:1;">
                        <label style="font-size:14px; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted);">Expiry</label>
                        <input type="text" required placeholder="MM/YY" style="width:100%; padding:15px; margin-top:8px; background:rgba(0,0,0,0.3); color:#fff; border:1px solid var(--border); border-radius:8px; font-family:'Outfit', sans-serif;">
                    </div>
                    <div style="flex:1;">
                        <label style="font-size:14px; text-transform:uppercase; letter-spacing:1px; color:var(--text-muted);">CVV</label>
                        <input type="text" required placeholder="***" style="width:100%; padding:15px; margin-top:8px; background:rgba(0,0,0,0.3); color:#fff; border:1px solid var(--border); border-radius:8px; font-family:'Outfit', sans-serif;">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">Pay Now</button>
            </form>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
