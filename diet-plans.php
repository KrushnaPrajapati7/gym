<?php require_once 'includes/db.php'; ?>
<?php require_once 'includes/header.php'; ?>

<section class="container" style="padding: 100px 0;">
    <h1 class="section-title">Customized <span class="highlight">Diet Plans</span></h1>
    
    <div class="diet-calculator card" style="max-width: 600px; margin: 0 auto 50px; border-color: var(--secondary);">
        <h3 style="margin-bottom:20px; text-align:center; font-size:24px;">Macro Calculator & Plan Unlock</h3>
        <p style="text-align:center; color:var(--text-muted); margin-bottom: 30px;">Enter your details to unlock a custom PDF diet plan.</p>
        
        <form id="calcForm" onsubmit="return handleDietSubmit(event)">
            <div style="margin-bottom:15px;">
                <label style="font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:1px;">Weight (kg)</label>
                <input type="number" id="weight" required placeholder="e.g. 75" style="width:100%; padding:15px; margin-top:8px; background:rgba(0,0,0,0.3); color:#fff; border:1px solid var(--border); border-radius:8px; font-family:'Outfit', sans-serif;">
            </div>
            <div style="margin-bottom:15px;">
                <label style="font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:1px;">Height (cm)</label>
                <input type="number" id="height" required placeholder="e.g. 180" style="width:100%; padding:15px; margin-top:8px; background:rgba(0,0,0,0.3); color:#fff; border:1px solid var(--border); border-radius:8px; font-family:'Outfit', sans-serif;">
            </div>
            <div style="margin-bottom:25px;">
                <label style="font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:1px;">Goal</label>
                <select id="goal" style="width:100%; padding:15px; margin-top:8px; background:rgba(0,0,0,0.3); color:#fff; border:1px solid var(--border); border-radius:8px; font-family:'Outfit', sans-serif; cursor:pointer;">
                    <option value="Bulking" style="background:var(--bg-color);">Bulking</option>
                    <option value="Cutting" style="background:var(--bg-color);">Cutting</option>
                    <option value="Maintenance" style="background:var(--bg-color);">Maintenance</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; border-radius:8px;">Calculate & Unlock Plan</button>
        </form>

        <div id="resultArea" style="display:none; margin-top:30px; text-align:center; padding:30px; border-top:1px solid var(--border); background:rgba(0, 210, 255, 0.05); border-radius: 8px;">
            <h4 style="color:var(--secondary); margin-bottom:15px; font-size:20px; text-transform:uppercase; letter-spacing:1px;">Your Daily Macros</h4>
            <div style="display:flex; justify-content:space-around; margin-bottom:20px;">
                <div>
                    <div style="font-size:32px; font-weight:800; color:#fff;" id="resProtein"></div>
                    <div style="font-size:12px; color:var(--text-muted); text-transform:uppercase;">Protein (g)</div>
                </div>
                <div>
                    <div style="font-size:32px; font-weight:800; color:#fff;" id="resCarbs"></div>
                    <div style="font-size:12px; color:var(--text-muted); text-transform:uppercase;">Carbs (g)</div>
                </div>
                <div>
                    <div style="font-size:32px; font-weight:800; color:#fff;" id="resFat"></div>
                    <div style="font-size:12px; color:var(--text-muted); text-transform:uppercase;">Fat (g)</div>
                </div>
            </div>
            <a href="#" id="downloadPdf" class="btn btn-outline" style="width:100%; border-radius:8px; margin-top:10px;">Download PDF Plan <span style="font-size:10px; color:var(--text-muted);">(Mock)</span></a>
        </div>
    </div>
</section>

<script>
function handleDietSubmit(e) {
    e.preventDefault();
    const weight = parseFloat(document.getElementById('weight').value);
    const goal = document.getElementById('goal').value;

    let multiplier = 2; // Maintenance
    if(goal === 'Bulking') multiplier = 2.2;
    if(goal === 'Cutting') multiplier = 1.8;

    const protein = Math.round(weight * multiplier);
    const fat = Math.round(weight * 1);
    const carbs = Math.round((protein * 4 + fat * 9) * 0.5);

    document.getElementById('resProtein').innerText = protein;
    document.getElementById('resCarbs').innerText = carbs;
    document.getElementById('resFat').innerText = fat;

    document.getElementById('downloadPdf').href = '/Gym/assets/pdfs/' + goal.toLowerCase() + '_plan.pdf';
    document.getElementById('downloadPdf').setAttribute('download', '');
    document.getElementById('resultArea').style.display = 'block';
}
</script>

<?php require_once 'includes/footer.php'; ?>
