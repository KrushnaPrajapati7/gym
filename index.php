<?php require_once 'includes/db.php'; ?>
<?php require_once 'includes/header.php'; ?>

<!-- Epic Hero Section -->
<!-- The background image will be added to assets/images/hero_bg.png -->
<section class="hero" style="background-image: linear-gradient(rgba(13,13,18,0.7), rgba(13,13,18,0.9)), url('/Gym/assets/images/hero_bg.png');">
    <div class="container hero-content">
        <h1 class="hero-title">Transform Your Body.<br><span class="highlight">Redefine Your Limits.</span></h1>
        <p class="hero-subtitle">Premium equipment, elite trainers, and customized paths to your goals.</p>
        <div class="hero-cta">
            <a href="/Gym/register.php" class="btn btn-primary" style="font-size: 18px; padding: 15px 40px;">Join Now</a>
            <a href="/Gym/login.php" class="btn btn-outline" style="font-size: 18px; padding: 15px 40px; margin-left: 20px;">Member Login</a>
        </div>
    </div>
</section>

<!-- Equipment Showcase -->
<section class="equipment-showcase container">
    <h2 class="section-title">Premium <span class="highlight">Equipment</span></h2>
    <div class="equipment-grid">
        <?php
        $stmt = $pdo->query("SELECT * FROM equipment");
        $equipments = $stmt->fetchAll();
        foreach ($equipments as $eq):
            // Calculate a mock percentage
            $usage_percent = ($eq['in_use_count'] / $eq['total_count']) * 100;
            $color = $usage_percent > 80 ? 'var(--primary)' : ($usage_percent > 50 ? '#ffb347' : 'var(--secondary)');
        ?>
        <div class="card equipment-card">
            <h3><?= htmlspecialchars($eq['name']) ?></h3>
            <p class="brand">By <?= htmlspecialchars($eq['brand']) ?></p>
            <div class="availability">
                <p>Live Status:</p>
                <div class="progress-bar">
                    <div class="progress" style="width: <?= $usage_percent ?>%; background-color: <?= $color ?>; box-shadow: 0 0 10px <?= $color ?>;"></div>
                </div>
                <p class="status-text"><?= $eq['in_use_count'] ?> / <?= $eq['total_count'] ?> In Use</p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Subscriptions -->
<section class="subscriptions container">
    <h2 class="section-title">Membership <span class="highlight">Plans</span></h2>
    <div class="pricing-grid">
        <div class="card pricing-card">
            <h3>Basic</h3>
            <div class="price">₹2499<span>/mo</span></div>
            <ul class="features">
                <li>✔ Gym access</li>
                <li>✔ 1 Guest pass/mo</li>
                <li class="muted">✘ All classes</li>
                <li class="muted">✘ Sauna & Tanning</li>
                <li class="muted">✘ Personal Trainer</li>
            </ul>
            <a href="/Gym/update_tier.php?plan=Basic" class="btn btn-outline">Choose Basic</a>
        </div>
        <div class="card pricing-card popular">
            <div class="badge">Most Popular</div>
            <h3>Pro</h3>
            <div class="price">₹4999<span>/mo</span></div>
            <ul class="features">
                <li>✔ Gym access</li>
                <li>✔ 1 Guest pass/mo</li>
                <li>✔ All classes</li>
                <li>✔ Sauna & Tanning</li>
                <li class="muted">✘ Personal Trainer</li>
            </ul>
            <a href="/Gym/update_tier.php?plan=Pro" class="btn btn-primary">Choose Pro</a>
        </div>
        <div class="card pricing-card">
            <h3>Elite</h3>
            <div class="price">₹8999<span>/mo</span></div>
            <ul class="features">
                <li>✔ Gym access</li>
                <li>✔ Unlimited Guest passes</li>
                <li>✔ All classes</li>
                <li>✔ Sauna & Tanning</li>
                <li>✔ Personal Trainer</li>
                <li>✔ Custom Diet & Recovery Zone</li>
            </ul>
            <a href="/Gym/update_tier.php?plan=Elite" class="btn btn-outline">Choose Elite</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
