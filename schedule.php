<?php require_once 'includes/db.php'; ?>
<?php require_once 'includes/header.php'; ?>

<section class="container" style="padding: 100px 0;">
    <h1 class="section-title">Schedule & <span class="highlight">Trainers</span></h1>
    
    <div style="display:flex; flex-wrap:wrap; gap:50px;">
        
        <!-- Trainer Profiles -->
        <div style="flex: 1 1 300px;">
            <h2 style="font-size:28px; margin-bottom:30px; border-bottom:1px solid var(--border); padding-bottom:10px;">Elite Coaches</h2>
            <?php
            $stmt = $pdo->query("SELECT * FROM trainers");
            $trainers = $stmt->fetchAll();
            foreach ($trainers as $trainer):
            ?>
            <div class="card" style="margin-bottom:20px; display:flex; align-items:center; gap:20px; padding:20px;">
                <!-- Mock image block -->
                <div style="width:80px; height:80px; border-radius:50%; background:var(--secondary); background-image:url('<?= htmlspecialchars($trainer['image_url']) ?>'); background-size:cover; border:2px solid var(--primary);"></div>
                <div>
                    <h3 style="font-size:20px;"><?= htmlspecialchars($trainer['name']) ?></h3>
                    <p style="color:var(--primary); font-size:12px; text-transform:uppercase; letter-spacing:1px; margin-bottom:5px;"><?= htmlspecialchars($trainer['specialty']) ?></p>
                    <p style="color:var(--text-muted); font-size:14px;"><?= htmlspecialchars($trainer['bio']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Class Schedule Calendar -->
        <div style="flex: 2 1 500px;">
            <h2 style="font-size:28px; margin-bottom:30px; border-bottom:1px solid var(--border); padding-bottom:10px;">Weekly Schedule</h2>
            <div style="background:var(--card-bg); border:1px solid var(--border); border-radius:var(--radius); overflow:hidden;">
                <table style="width:100%; border-collapse:collapse; text-align:left;">
                    <thead>
                        <tr style="background:rgba(255,255,255,0.05);">
                            <th style="padding:15px; border-bottom:1px solid var(--border);">Class</th>
                            <th style="padding:15px; border-bottom:1px solid var(--border);">Day</th>
                            <th style="padding:15px; border-bottom:1px solid var(--border);">Time</th>
                            <th style="padding:15px; border-bottom:1px solid var(--border);">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT classes.*, trainers.name as trainer_name FROM classes JOIN trainers ON classes.trainer_id = trainers.id ORDER BY FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), start_time");
                        $classes = $stmt->fetchAll();
                        foreach ($classes as $class):
                        ?>
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.05); transition:background 0.3s;" onmouseover="this.style.background='rgba(255,51,102,0.1)'" onmouseout="this.style.background='transparent'">
                            <td style="padding:15px;">
                                <strong><?= htmlspecialchars($class['name']) ?></strong><br>
                                <span style="font-size:12px; color:var(--text-muted);">with <?= htmlspecialchars($class['trainer_name']) ?></span>
                            </td>
                            <td style="padding:15px;"><?= htmlspecialchars($class['day_of_week']) ?></td>
                            <td style="padding:15px;"><?= date('h:i A', strtotime($class['start_time'])) ?></td>
                            <td style="padding:15px;">
                                <form action="/Gym/book.php" method="POST">
                                    <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                                    <button type="submit" class="btn btn-outline" style="padding:6px 15px; font-size:12px;">Book</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
