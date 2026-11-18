<?php
require_once "../config/app.php";wajib_admin();if(!isset($page_title))$page_title="Admin";
include "../includes/header.php";
?>
<div class="container-fluid px-3 px-lg-4 py-4"><div class="row g-3"><div class="col-lg-2"><div class="admin-sidebar"><div class="text-white small fw-bold mb-3">PANEL ADMIN</div><a href="dashboard.php">Dashboard</a><a href="kontestan.php">Kelola kontestan</a><a href="pemilih.php">Data pemilih</a><a href="pembayaran.php">Verifikasi pembayaran</a><a href="periode.php">Periode & harga</a><a href="hasil.php">Hasil voting</a><a href="../index.php">Lihat website</a></div></div><div class="col-lg-10"><h1 class="admin-title mb-4"><?=e($page_title)?></h1>
