<?php 
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['action']) && $_POST['action'] === 'add') {
        $id = $_POST['product_id'];
        if(isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }
    }
}
?>
<?php require_once 'includes/header.php'; ?>

<section class="container" style="padding: 100px 0; min-height:80vh;">
    <h1 class="section-title">Your <span class="highlight">Cart</span></h1>
    
    <div class="card" style="max-width:800px; margin:0 auto; padding:30px;">
        <?php if(empty($_SESSION['cart'])): ?>
            <p style="text-align:center; color:var(--text-muted);">Your cart is empty.</p>
            <div style="text-align:center; margin-top:20px;">
                <a href="/Gym/shop.php" class="btn btn-outline">Go to Shop</a>
            </div>
        <?php else: ?>
            <table style="width:100%; border-collapse:collapse; margin-bottom:30px;">
                <thead>
                    <tr style="border-bottom:1px solid var(--border);">
                        <th style="text-align:left; padding:10px;">Product</th>
                        <th style="padding:10px;">Qty</th>
                        <th style="text-align:right; padding:10px;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach($_SESSION['cart'] as $id => $qty): 
                        $stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
                        $stmt->execute([$id]);
                        $p = $stmt->fetch();
                        if($p):
                            $subtotal = $p['price'] * $qty;
                            $total += $subtotal;
                    ?>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.05);">
                        <td style="padding:15px; font-weight:600;"><?= htmlspecialchars($p['name']) ?></td>
                        <td style="padding:15px; text-align:center;"><?= $qty ?></td>
                        <td style="padding:15px; text-align:right;">₹<?= number_format($subtotal, 2) ?></td>
                    </tr>
                    <?php endif; endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" style="text-align:right; padding:20px 15px; font-size:20px;">Total:</th>
                        <th style="text-align:right; padding:20px 15px; font-size:24px; color:var(--primary);">₹<?= number_format($total, 2) ?></th>
                    </tr>
                </tfoot>
            </table>
            
            <div style="display:flex; justify-content:space-between;">
                <a href="/Gym/shop.php" class="btn btn-outline">Continue Shopping</a>
                <a href="/Gym/checkout.php" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
