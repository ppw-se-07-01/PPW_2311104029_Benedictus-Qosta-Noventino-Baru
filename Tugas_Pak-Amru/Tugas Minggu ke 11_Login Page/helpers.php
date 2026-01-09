<?php
require_once __DIR__ . '/db.php';

// Cari user berdasarkan username. Asumsikan tabel `users` dengan kolom
// `id`, `username`, `password_hash`.
function find_user_by_username(string $username)
{
	$pdo = getPDO();
	$stmt = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = ? LIMIT 1');
	$stmt->execute([$username]);
	return $stmt->fetch();
}

function verify_user(string $username, string $password)
{
	$user = find_user_by_username($username);
	if ($user && password_verify($password, $user['password_hash'])) {
		return $user;
	}
	return false;
}

function login_user_session(array $user)
{
	if (session_status() === PHP_SESSION_NONE) session_start();
	$_SESSION['user_id'] = $user['id'];
	$_SESSION['username'] = $user['username'];
}

/* Persistent remember-me token implementation
   Uses table `remember_tokens` with columns: selector, token_hash, user_id, expires
   Cookie contains selector:token (both hex). The DB stores hash(token).
*/
function create_remember_token(int $user_id)
{
	$pdo = getPDO();
	$selector = bin2hex(random_bytes(SELECTOR_BYTES));
	$token = bin2hex(random_bytes(TOKEN_BYTES));
	$token_hash = hash('sha256', $token);
	$expires = date('Y-m-d H:i:s', time() + REMEMBER_EXPIRE_DAYS * 24 * 60 * 60);

	$stmt = $pdo->prepare('INSERT INTO remember_tokens (selector, token_hash, user_id, expires) VALUES (?, ?, ?, ?)');
	$stmt->execute([$selector, $token_hash, $user_id, $expires]);

	$cookie_value = $selector . ':' . $token;
	setcookie(REMEMBER_COOKIE_NAME, $cookie_value, time() + REMEMBER_EXPIRE_DAYS * 24 * 60 * 60, '/', '', false, true);
}

function find_remember_token_by_selector(string $selector)
{
	$pdo = getPDO();
	$stmt = $pdo->prepare('SELECT * FROM remember_tokens WHERE selector = ? AND expires > NOW() LIMIT 1');
	$stmt->execute([$selector]);
	return $stmt->fetch();
}

function delete_remember_token_by_selector(string $selector)
{
	$pdo = getPDO();
	$stmt = $pdo->prepare('DELETE FROM remember_tokens WHERE selector = ?');
	$stmt->execute([$selector]);
}

function cleanup_expired_remember_tokens()
{
	$pdo = getPDO();
	$pdo->exec('DELETE FROM remember_tokens WHERE expires <= NOW()');
}

function logout_user()
{
	if (session_status() === PHP_SESSION_NONE) session_start();
	// Hapus token yang terkait dengan cookie (jika ada)
	if (!empty($_COOKIE[REMEMBER_COOKIE_NAME])) {
		$parts = explode(':', $_COOKIE[REMEMBER_COOKIE_NAME], 2);
		if (count($parts) === 2) {
			$selector = $parts[0];
			delete_remember_token_by_selector($selector);
		}
		setcookie(REMEMBER_COOKIE_NAME, '', time() - 3600, '/');
	}

	$_SESSION = [];
	if (ini_get('session.use_cookies')) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
	}
	session_destroy();
}

function ensure_logged_in()
{
	if (session_status() === PHP_SESSION_NONE) session_start();
	if (!empty($_SESSION['user_id'])) return true;

	// Cek cookie remember-me persistent
	if (!empty($_COOKIE[REMEMBER_COOKIE_NAME])) {
		$parts = explode(':', $_COOKIE[REMEMBER_COOKIE_NAME], 2);
		if (count($parts) === 2) {
			[$selector, $token] = $parts;
			$row = find_remember_token_by_selector($selector);
			if ($row) {
				$token_hash = hash('sha256', $token);
				if (hash_equals($row['token_hash'], $token_hash)) {
					// Token valid -> login user and rotate token
					$pdo = getPDO();
					$stmt = $pdo->prepare('SELECT id, username FROM users WHERE id = ? LIMIT 1');
					$stmt->execute([$row['user_id']]);
					$user = $stmt->fetch();
					if ($user) {
						login_user_session($user);
						// delete old token and create a new one (rotation)
						delete_remember_token_by_selector($selector);
						create_remember_token((int)$user['id']);
						cleanup_expired_remember_tokens();
						return true;
					}
				} else {
					// Token mismatch -> possible theft, delete token
					delete_remember_token_by_selector($selector);
				}
			}
		}
	}

	header('Location: login.php');
	exit;
}

?>

