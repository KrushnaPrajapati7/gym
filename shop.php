<?php require_once 'includes/db.php'; ?>
<?php require_once 'includes/header.php'; ?>

<section class="container" style="padding: 100px 0;">
    <h1 class="section-title">Premium <span class="highlight">Supplements</span></h1>
    
    <div class="shop-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
        <?php
        $stmt = $pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll();
        foreach ($products as $prod):
        ?>
        <div class="card product-card" style="text-align:center;">
            <!-- Placeholder for product image -->
            <div style="background:#1a1a24; height:200px; border-radius:8px; margin-bottom:20px; display:flex; align-items:center; justify-content:center;">
                <span style="color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:1px;"><?= htmlspecialchars($prod['type']) ?></span>
            </div>
            
            <h3 style="font-size: 20px; margin-bottom:10px;"><?= htmlspecialchars($prod['name']) ?></h3>
            <!-- Fake reviews to build 'trust' as requested -->
            <div class="reviews" style="color: #ffcc00; margin-bottom:15px; font-size:14px; letter-spacing: 2px;">
                ★★★★★ <span style="color:var(--text-muted); letter-spacing: 0;">(<?= htmlspecialchars($prod['rating']) ?> - <?= htmlspecialchars($prod['reviews_count']) ?> reviews)</span>
            </div>
            <div class="price" style="font-size:28px; font-weight:800; color:var(--text-color); margin-bottom:20px;">
                ₹<?= htmlspecialchars($prod['price']) ?>
            </div>
            <form action="/Gym/cart.php" method="POST">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_id" value="<?= $prod['id'] ?>">
                <button type="submit" class="btn btn-primary" style="width:100%; border-radius:8px;">Add to Cart</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
