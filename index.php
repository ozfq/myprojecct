
<?php
require_once 'db.php';
require_once 'config.php';

$pageTitle = 'الرئيسية';
$participants = [];
$count = 0;

if (isset($conn) && $conn) {
    $result = $conn->query("SELECT id, first_name, last_name, email, phone, created_at FROM participants ORDER BY id DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $participants[] = $row;
        }
        $count = count($participants);
    }
}

$registered = isset($_GET['registered']);
$error = $_GET['error'] ?? '';
include 'parts/header.php';
?>

<div class="container">
    <h1 class="main-title">اربح مع أحمد عدنان الكعبور</h1>
    <p class="subtitle">باقي على فتح التسجيل</p>

    <!-- العداد التنازلي -->
    <div id="countdown" class="countdown-timer">
        <span id="days">13</span> يوم 
        <span id="hours">11</span> ساعة 
        <span id="minutes">49</span> دقيقة 
        <span id="seconds">57</span> ثانية
    </div>

    <p class="description">للسحب على ربح نسخة مجانية من برنامج</p>
    <div class="coming-soon-btn">Coming soon</div>

    <!-- إظهار رسائل الخطأ إن أُرجعت من save.php -->
    <?php if ($error === 'invalid'): ?>
        <div style="color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 20px; font-size: 0.9rem;">
            يرجى التأكد من إدخال جميع البيانات والبريد الإلكتروني بشكل صحيح.
        </div>
    <?php elseif ($error === 'duplicate'): ?>
        <div style="color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 20px; font-size: 0.9rem;">
            البريد الإلكتروني مُسجل مسبقاً!
        </div>
    <?php elseif ($error === 'db'): ?>
        <div style="color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 20px; font-size: 0.9rem;">
            حدث خطأ أثناء الاتصال بقاعدة البيانات.
        </div>
    <?php endif; ?>

    <div class="info-list">
        <div class="info-item">تاريخ البث المباشر على صفحتي على فيسبوك بتاريخ المذكور أعلاه</div>
        <div class="info-item">سأقوم ببث مباشر لمدة ساعة عبارة عن أسئلة وأجوبة حرة للجميع</div>
        <div class="info-item">خلال فترة الساعة سيتم فتح صفحة التسجيل هنا حيث ستقوم بتسجيل اسمك وإيميلك</div>
        <div class="info-item">بنهاية البث سيتم اختيار اسم واحد من قاعدة البيانات بشكل عشوائي</div>
        <div class="info-item">الرابح سيحصل على نسخة مجانية من برنامج كامتازيا</div>
    </div>

    <div class="form-section" id="register">
        <h2 class="form-title">الرجاء أدخل معلوماتك</h2>
        
        <form action="save.php" method="POST" class="user-form">
            <div class="input-group">
                <label for="first_name">الاسم الأول</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="input-group">
                <label for="last_name">الاسم الأخير</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="input-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="phone">رقم الهاتف</label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <!-- حقل مخفي للموافقة ليتوافق مع $agree في save.php -->
            <input type="hidden" name="agree" value="1">

            <button type="submit" name="submit" class="btn-submit">إرسال المعلومات</button>
        </form>

        <div class="winner-section">
            <a href="select.php" class="btn-winner" style="display:inline-block; text-decoration:none; text-align:center;">اختيار الرابح</a>
        </div>
    </div>
</div>

<script>
    const targetDate = new Date().getTime() + (13 * 24 * 60 * 60 * 1000) + (11 * 60 * 60 * 1000) + (49 * 60 * 1000) + (57 * 1000);
    const timer = setInterval(function() {
        const now = new Date().getTime();
        const distance = targetDate - now;
        if (distance < 0) {
            clearInterval(timer);
            document.getElementById("countdown").innerHTML = "تم فتح التسجيل!";
            return;
        }
        document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24));
        document.getElementById("hours").innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        document.getElementById("minutes").innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        document.getElementById("seconds").innerText = Math.floor((distance % (1000 * 60)) / 1000);
    }, 1000);
</script>

<?php include 'parts/footer.php'; ?>