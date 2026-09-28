<?php
// Mulai sesi untuk mendapatkan akses ke sesi saat ini
session_start();

// Hapus semua variabel sesi (mengosongkan array $_SESSION)
$_SESSION = [];
session_unset();

// Hancurkan sesi secara permanen di server
session_destroy();

// Arahkan pengguna kembali ke halaman pilihan akses (atau index.php)
header("Location: index.php");
exit;
?>