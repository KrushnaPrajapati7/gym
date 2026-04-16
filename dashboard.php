<?php 
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'includes/db.php';
require_once 'includes/header.php'; 

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<section class="container" style="padding: 100px 0;">
    <h1 class="section-title">Welcome back, <span class="highlight"><?= htmlspecialchars($user['name']) ?></span></h1>
    
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap:30px;">
        
        <!-- Stats Card -->
        <div class="card">
            <h3 style="font-size:22px; margin-bottom:20px; border-bottom:1px solid var(--border); padding-bottom:10px;">Your Stats</h3>
            <div style="display:flex; justify-content:space-between; margin-bottom:15px; border-bottom:1px solid rgba(255,255,255,0.05); padding-bottom:10px;">
                <span style="color:var(--text-muted);">Current Tier</span>
                <strong style="color:var(--primary);"><?= htmlspecialchars($user['membership_tier'] ?? 'None') ?></strong>
            </div>
            <div style="display:flex; justify-content:space-between; margin-bottom:15px; border-bottom:1px solid rgba(255,255,255,0.05); padding-bottom:10px;">
                <span style="color:var(--text-muted);">Workout Streak</span>
                <strong>🔥 5 Days</strong>
            </div>
            <div style="display:flex; justify-content:space-between;">
                <span style="color:var(--text-muted);">Personal Best (Bench)</span>
                <strong>100 kg</strong>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <h3 style="font-size:22px; margin-bottom:20px; border-bottom:1px solid var(--border); padding-bottom:10px;">Quick Actions</h3>
            <a href="/Gym/diet-plans.php" class="btn btn-outline" style="display:block; text-align:center; margin-bottom:15px;">Update Diet Goal</a>
            <a href="/Gym/schedule.php" class="btn btn-primary" style="display:block; text-align:center;">Book a Class</a>
        </div>
        
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
