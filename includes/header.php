<?php
if (!isset($page_title)) $page_title = "Kakang Senduk Ponorogo";
$flash_data = ambil_flash();
$base_path = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) ? '../' : '';
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page_title) ?> | Kakang Senduk Ponorogo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="<?= $base_path ?>assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light sticky-top nav-glass">
 <div class="container">
  <a class="navbar-brand brand" href="<?= $base_path ?>index.php"><span class="brand-mark">KS</span><span>KAKANG SENDUK<small>PONOROGO • 2026</small></span></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"><span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="navMenu">
   <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
    <li class="nav-item"><a class="nav-link" href="<?= $base_path ?>index.php">Beranda</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= $base_path ?>kontestan.php">Kontestan</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= $base_path ?>klasemen.php">Klasemen</a></li>
    <?php if (is_login()): ?>
      <li class="nav-item"><a class="nav-link" href="<?= $base_path ?>riwayat.php">Riwayat</a></li>
      <?php if (is_admin()): ?><li class="nav-item"><a class="nav-link" href="<?= $base_path ?>admin/dashboard.php">Dashboard Admin</a></li><?php endif; ?>
      <li class="nav-item"><a class="btn btn-maroon btn-sm px-3" href="<?= $base_path ?>logout.php">Keluar</a></li>
    <?php else: ?>
      <li class="nav-item"><a class="nav-link" href="<?= $base_path ?>login.php">Masuk</a></li>
      <li class="nav-item"><a class="btn btn-maroon btn-sm px-3" href="<?= $base_path ?>register.php">Daftar akun</a></li>
    <?php endif; ?>
   </ul>
  </div>
 </div>
</nav>
<main>
<?php if ($flash_data): ?>
<div class="container pt-3"><div class="alert alert-<?= e($flash_data['type']) ?> alert-dismissible fade show"><?= e($flash_data['message']) ?><button class="btn-close" data-bs-dismiss="alert"></button></div></div>
<?php endif; ?>
