
<?php
require_once 'db.php';
$pageTitle = 'لوحة السحب';
$winner = null;
$participants = [];
$count = 0;

if ($conn) {
    $result = $conn->query('SELECT id, ticket_no, first_name, last_name, email, phone, created_at FROM participants ORDER BY id DESC');
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $participants[] = $row;
        }
    }
    $count = count($participants);
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['draw']) && $count > 0) {
        $pick = random_int(0, $count - 1);
        $winner = $participants[$pick];
    }
}
include 'parts/header.php';
?>

<!-- تنسيق تأثير الاحتفال المضمون -->
<style>
.confetti {
    position: fixed;
    width: 10px;
    height: 10px;
    background-color: #f2d74e;
    top: -10px;
    z-index: 9999;
    pointer-events: none;
    border-radius: 2px;
    animation: confetti-fall 2.5s linear forwards;
}
@keyframes confetti-fall {
    0% {
        transform: translateY(0) rotate(0deg);
        opacity: 1;
    }
    100% {
        transform: translateY(100vh) rotate(720deg);
        opacity: 0;
    }
}
</style>

<section class="admin-page">
  <div class="container">
    <div class="admin-head">
      <div>
        <div class="eyebrow">لوحة التحكم</div>
        <h1>اختيار الفائز</h1>
        <p>عدد المشاركين الحالي: <strong><?= $count ?></strong></p>
      </div>
      <form method="post">
        <button class="btn btn-primary draw-btn" name="draw" value="1" <?= $count ? '' : 'disabled' ?>>
          سحب فائز الآن <span>🎲</span>
        </button>
      </form>
    </div>

    <?php if ($winner): ?>
      <div class="winner-card" id="winnerCard">
        <div class="confetti-mark">🏆</div>
        <span>الفائز</span>
        <h2><?= e($winner['first_name'].' '.$winner['last_name']) ?></h2>
        <p>رقم المشاركة: <b><?= e($winner['ticket_no']) ?></b></p>
        <button class="btn btn-ghost" type="button" onclick="celebrate()">احتفال 🎉</button>
      </div>
    <?php endif; ?>

    <div class="list-card">
      <div class="list-head">
        <h2>قائمة المشاركين</h2>
        <span><?= $count ?> مشارك</span>
      </div>
      <?php if (!$participants): ?>
        <div class="empty-state">
          <div>◎</div>
          <h3>لا توجد بيانات</h3>
          <p>سجّل أول مشاركة من الصفحة الرئيسية.</p>
        </div>
      <?php else: ?>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد</th>
                <th>الجوال</th>
                <th>رقم المشاركة</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($participants as $p): ?>
                <tr>
                  <td><?= e($p['id']) ?></td>
                  <td><strong><?= e($p['first_name'].' '.$p['last_name']) ?></strong></td>
                  <td><?= e($p['email']) ?></td>
                  <td><?= e($p['phone']) ?></td>
                  <td><span class="ticket-pill"><?= e($p['ticket_no']) ?></span></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- دالة احتفال مستقلة تضمن العمل فوراً بدون اعتمادات مفقودة -->
<script>
function celebrate() {
    const colors = ['#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#2196f3', '#03a9f4', '#00bcd4', '#009688', '#4caf50', '#8bc34a', '#cddc39', '#ffeb3b', '#ffc107', '#ff9800'];
    for (let i = 0; i < 50; i++) {
        const el = document.createElement('span');
        el.className = 'confetti';
        el.style.left = Math.random() * 100 + 'vw';
        el.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        el.style.animationDuration = (Math.random() * 2 + 1.5) + 's';
        el.style.width = (Math.random() * 8 + 6) + 'px';
        el.style.height = (Math.random() * 10 + 8) + 'px';
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 3500);
    }
}

<?php if ($winner): ?>
document.addEventListener('DOMContentLoaded', function() {
    celebrate();
});
<?php endif; ?>
</script>

<?php include 'parts/footer.php'; ?>