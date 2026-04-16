<?php 
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if(isset($_GET['plan'])) {
    $plan = $_GET['plan'];
    $valid_plans = ['Basic', 'Pro', 'Elite'];
    
    if(in_array($plan, $valid_plans)) {
        $stmt = $pdo->prepare("UPDATE users SET membership_tier = ? WHERE id = ?");
        $stmt->execute([$plan, $_SESSION['user_id']]);
    }
}
header("Location: dashboard.php");
exit;
?>
