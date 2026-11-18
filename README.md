# Voting Kakang Senduk Ponorogo

Aplikasi PHP native + MySQL untuk proyek pemilihan Kakang Senduk Ponorogo.

## Instalasi XAMPP
1. Ekstrak folder `voting-kakang-senduk` ke `C:\xampp\htdocs\`.
2. Jalankan Apache dan MySQL dari XAMPP Control Panel.
3. Buka `http://localhost/phpmyadmin`.
4. Import file `database.sql`.
5. Buka `http://localhost/voting-kakang-senduk/buat-admin.php` satu kali untuk membuat akun admin.
6. Login melalui `http://localhost/voting-kakang-senduk/login.php`.
7. Email admin: `admin@kakangsenduk.test`
8. Password awal: `AdminKS2026!`
9. Setelah admin berhasil dibuat, HAPUS `buat-admin.php` dan ubah password admin sebelum aplikasi digunakan sungguhan.

## Alur admin
- Buka Dashboard Admin.
- Tambahkan kontestan dan foto.
- Buat periode voting, tentukan harga per suara, tanggal, status, dan informasi rekening.
- Buka menu Verifikasi Pembayaran.
- Periksa bukti transfer, lalu setujui atau tolak. Suara baru masuk klasemen setelah disetujui.

## Mengganti foto
Foto kontestan dapat diunggah melalui Admin > Kelola kontestan. Foto tersimpan di `uploads/kontestan/`.
Untuk banner, letakkan file `hero-bg.jpg` di `assets/img/`. Jika ingin memakai nama lain, ubah alamat gambar pada `assets/css/style.css`.

## Catatan pembayaran
Versi ini memakai transfer manual dan verifikasi admin. Belum terhubung ke payment gateway/QRIS otomatis. Jangan gunakan untuk transaksi uang sungguhan sebelum menambahkan HTTPS, backup, audit log, pembatasan akses file bukti, validasi operasional, dan integrasi pembayaran resmi.
# voting
