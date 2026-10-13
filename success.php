<?php
require_once 'db.php';
$pageTitle = 'تم التسجيل';
$ticket = $_GET['ticket'] ?? '------';
$name = $_GET['name'] ?? '';
include 'parts/header.php';
?>
<section class="success-page"><div class="container"><div class="success-card">
  <div class="success-icon">✓</div><div class="eyebrow">تمت العملية بنجاح</div>
  <h1>أهلًا <?= e($name) ?></h1><p>تم حفظ مشاركتك في قاعدة البيانات. احتفظ برقم المشاركة.</p>
  <div class="ticket-label">رقم المشاركة</div><div class="ticket"><?= e($ticket) ?></div>
  <div class="success-actions"><a class="btn btn-primary" href="index.php">العودة للرئيسية</a><button class="btn btn-ghost" type="button" onclick="copyTicket('<?= e($ticket) ?>')">نسخ الرقم</button></div>
</div></div></section>
<?php include 'parts/footer.php'; ?>
