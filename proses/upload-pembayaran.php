<?php
require_once "../config/app.php";wajib_login();if(is_admin())redirect("../admin/dashboard.php");
$c=$_SESSION['checkout']??null;if(!$c){flash("Sesi pembayaran tidak ditemukan.","danger");redirect("../kontestan.php");}
if(!isset($_FILES['bukti'])||$_FILES['bukti']['error']!==UPLOAD_ERR_OK){flash("Bukti pembayaran wajib diunggah.","danger");redirect("../riwayat.php");}
$f=$_FILES['bukti'];if($f['size']>3*1024*1024){flash("Ukuran file maksimal 3 MB.","danger");redirect("../riwayat.php");}
$ext=strtolower(pathinfo($f['name'],PATHINFO_EXTENSION));if(!in_array($ext,['jpg','jpeg','png','pdf'])){flash("Format file tidak didukung.","danger");redirect("../riwayat.php");}
$mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);$allowed=['image/jpeg','image/png','application/pdf'];if(!in_array($mime,$allowed)){flash("Isi file tidak valid.","danger");redirect("../riwayat.php");}
$name='bukti_'.$_SESSION['user']['id'].'_'.bin2hex(random_bytes(6)).'.'.$ext;$path='../uploads/pembayaran/'.$name;
if(!move_uploaded_file($f['tmp_name'],$path)){flash("Upload gagal.","danger");redirect("../riwayat.php");}
$uid=$_SESSION['user']['id'];$kid=(int)$c['kontestan_id'];$pid=(int)$c['periode_id'];$jumlah=(int)$c['jumlah'];$total=(int)$c['total'];$pengirim=trim($_POST['nama_pengirim']??'');$dbpath='uploads/pembayaran/'.$name;
$ins=$conn->prepare("INSERT INTO pembayaran(user_id,kontestan_id,periode_id,jumlah_suara,total_bayar,nama_pengirim,bukti,status) VALUES(?,?,?,?,?,?,?,'Menunggu')");
$ins->bind_param("iiiiiss",$uid,$kid,$pid,$jumlah,$total,$pengirim,$dbpath);
if($ins->execute()){unset($_SESSION['checkout']);flash("Bukti pembayaran terkirim. Suara menunggu verifikasi admin.");redirect("../riwayat.php");}
@unlink($path);flash("Gagal menyimpan pembayaran.","danger");redirect("../riwayat.php");
