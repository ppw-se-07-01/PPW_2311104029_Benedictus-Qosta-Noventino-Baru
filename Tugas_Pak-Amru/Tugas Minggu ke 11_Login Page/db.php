<?php
// Database configuration - sesuaikan dengan environment lokal Anda
$DB_HOST = '127.0.0.1';
$DB_NAME = 'auth_demo';
$DB_USER = 'root';
$DB_PASS = '';
$DB_CHARSET = 'utf8mb4';

$DSN = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset={$DB_CHARSET}";
$PDO_OPTIONS = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false,
];

// Secret key used to sign remember-me cookies. Ganti dengan nilai acak di produksi.
$AUTH_SECRET = 'CHANGE_THIS_TO_A_RANDOM_SECRET';

// Remember-me cookie name and expiry (in days)
define('REMEMBER_COOKIE_NAME', 'remember_auth');
define('REMEMBER_EXPIRE_DAYS', 30);

// Token lengths (in bytes before hex)
define('SELECTOR_BYTES', 9); // ~18 hex chars
define('TOKEN_BYTES', 32); // ~64 hex chars

function getPDO()
{
	global $DSN, $DB_USER, $DB_PASS, $PDO_OPTIONS;
	static $pdo = null;
	if ($pdo !== null) {
		return $pdo;
	}

	try {
		$pdo = new PDO($DSN, $DB_USER, $DB_PASS, $PDO_OPTIONS);
		return $pdo;
	} catch (PDOException $e) {
		// Untuk pengembangan, tampilkan pesan. Di produksi, log saja.
		die('Database connection failed: ' . $e->getMessage());
	}
}

// Catatan: Untuk keamanan produksi, jangan letakkan kredensial langsung di file.
// Gunakan environment variables atau file konfigurasi yang aman.

?>

