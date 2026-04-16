<?php 
// Mocking booking logic
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'includes/header.php'; 
?>

<section class="container" style="padding: 100px 0; min-height:80vh; display:flex; align-items:center; justify-content:center;">
    <div class="card" style="width:100%; max-width:500px; text-align:center;">
        <h2 style="color:var(--primary); margin-bottom:20px;">Class Booked!</h2>
        <p style="color:var(--text-muted); margin-bottom:30px;">You've successfully reserved your spot. We look forward to seeing you at the gym.</p>
        <a href="/Gym/schedule.php" class="btn btn-primary">Back to Schedule</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
