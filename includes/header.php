<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Hub | Redefine Your Limits</title>
    <!-- Use local css since we are making a custom aesthetic -->
    <link rel="stylesheet" href="/Gym/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container navbar">
            <a href="/Gym/index.php" class="logo">FITNESS HUB</a>
            <nav class="nav-links">
                <a href="/Gym/index.php">Home</a>
                <a href="/Gym/diet-plans.php">Diet Plans</a>
                <a href="/Gym/shop.php">Shop</a>
                <a href="/Gym/schedule.php">Schedule</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="/Gym/dashboard.php" style="margin-left:20px;">Dashboard</a>
                    <a href="/Gym/logout.php" class="btn btn-outline" style="margin-left:20px;">Logout</a>
                <?php else: ?>
                    <a href="/Gym/login.php" class="btn btn-primary" style="margin-left:30px;">Member Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <!-- main content starts -->
    <main>
