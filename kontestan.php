<?php
require_once "config/app.php";
$page_title="Daftar Kontestan";
$keyword=trim($_GET['cari']??''); $kategori=$_GET['kategori']??'';
$sql="SELECT * FROM kontestan WHERE 1=1"; $types=""; $params=[];
if($keyword!==""){$sql.=" AND (nama LIKE ? OR nomor_peserta LIKE ? OR asal_instansi LIKE ?)";$like="%$keyword%";$types.="sss";array_push($params,$like,$like,$like);}
if(in_array($kategori,['Kakang','Senduk'])){$sql.=" AND kategori=?";$types.="s";$params[]=$kategori;}
$sql.=" ORDER BY kategori, nomor_peserta";
$stmt=$conn->prepare($sql); if($types)$stmt->bind_param($types,...$params); $stmt->execute(); $data=$stmt->get_result();
include "includes/header.php";
?>
<div class="page-head"><div class="container"><div class="eyebrow">Finalis 2026</div><h1 class="section-title mb-1">Daftar Kontestan</h1><p class="small-muted mb-0">Kenali profil para calon Kakang dan Senduk Ponorogo.</p></div></div>
<div class="container py-5"><form class="row g-2 mb-4"><div class="col-md-7"><input class="form-control" name="cari" value="<?= e($keyword) ?>" placeholder="Cari nama, nomor peserta, atau instansi..."></div><div class="col-md-3"><select class="form-select" name="kategori"><option value="">Semua kategori</option><option <?= $kategori==='Kakang'?'selected':'' ?>>Kakang</option><option <?= $kategori==='Senduk'?'selected':'' ?>>Senduk</option></select></div><div class="col-md-2 d-grid"><button class="btn btn-maroon">Cari kontestan</button></div></form>
<div class="row g-4"><?php if($data->num_rows): while($k=$data->fetch_assoc()): ?><div class="col-6 col-lg-4"><div class="candidate-card h-100"><?php if($k['foto'] && file_exists(__DIR__.'/'.$k['foto'])): ?><img class="candidate-photo" src="<?= e($k['foto']) ?>" alt="<?= e($k['nama']) ?>"><?php else: ?><div class="candidate-placeholder"><?= e(strtoupper(substr($k['nama'],0,1))) ?></div><?php endif; ?><div class="p-3"><span class="tag"><?= e($k['kategori']) ?> • <?= e($k['nomor_peserta']) ?></span><div class="candidate-name mt-2"><?= e($k['nama']) ?></div><p class="small-muted"><?= e($k['asal_instansi']) ?></p><a class="btn btn-outline-maroon btn-sm w-100" href="detail-kontestan.php?id=<?= (int)$k['id'] ?>">Lihat profil</a></div></div></div><?php endwhile; else: ?><div class="col-12"><div class="panel p-4">Kontestan tidak ditemukan.</div></div><?php endif; ?></div></div>
<?php include "includes/footer.php"; ?>