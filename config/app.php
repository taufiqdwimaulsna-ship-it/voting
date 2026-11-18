<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . "/koneksi.php";

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function redirect($url) {
    header("Location: " . $url);
    exit;
}
function is_login() {
    return isset($_SESSION['user']);
}
function is_admin() {
    return is_login() && ($_SESSION['user']['role'] ?? '') === 'admin';
}
function wajib_login() {
    if (!is_login()) redirect("login.php");
}
function wajib_admin() {
    if (!is_admin()) redirect("../login.php");
}
function flash($message, $type = "success") {
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}
function ambil_flash() {
    if (empty($_SESSION['flash'])) return null;
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $f;
}
function periode_aktif($conn) {
    $q = $conn->query("SELECT * FROM periode_voting WHERE status='Aktif' AND NOW() BETWEEN tanggal_mulai AND tanggal_selesai ORDER BY id DESC LIMIT 1");
    return $q ? $q->fetch_assoc() : null;
}
