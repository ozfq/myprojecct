<?php
require_once __DIR__ . '/../config.php';
if (!isset($pageTitle)) $pageTitle = 'الرئيسية';
?>
<!doctype html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="مشروع سحب إلكتروني متكامل باسم محمد ثاري الرشيدي">
<title><?= e($pageTitle) ?> | <?= e(SITE_NAME) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="page-glow glow-one"></div>
<div class="page-glow glow-two"></div>
<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="index.php" aria-label="الرئيسية">
      <span class="brand-icon">أ</span>
      <span><b>أحمد عدنان الكعبور</b><small>مشروع السحب الإلكتروني</small></span>
    </a>
    <nav class="nav-links">
      <a href="index.php">الرئيسية</a>
      <a href="index.php#about">عن السحب</a>
      <a href="index.php#register">التسجيل</a>
      <a class="nav-admin" href="select.php">لوحة السحب</a>
    </nav>
  </div>
</header>
<main>
