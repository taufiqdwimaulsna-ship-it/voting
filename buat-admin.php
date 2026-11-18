<?php
require_once "config/app.php";
$email="admin@kakangsenduk.test";
$cek=$conn->prepare("SELECT id FROM users WHERE email=?");$cek->bind_param("s",$email);$cek->execute();
if($cek->get_result()->num_rows){exit("Admin sudah ada. Hapus file buat-admin.php setelah selesai.");}
$nama="Administrator";$hp="080000000000";$password=password_hash("AdminKS2026!",PASSWORD_DEFAULT);$role="admin";
$s=$conn->prepare("INSERT INTO users(nama,email,no_hp,password,role) VALUES(?,?,?,?,?)");$s->bind_param("sssss",$nama,$email,$hp,$password,$role);
echo $s->execute()?"Admin berhasil dibuat. Email: admin@kakangsenduk.test | Password: AdminKS2026!<br>SEGERA hapus file buat-admin.php dan ganti password admin setelah login.":"Gagal membuat admin.";
