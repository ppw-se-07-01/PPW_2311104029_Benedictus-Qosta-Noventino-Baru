<?php
require_once __DIR__ . '/helpers.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = trim($_POST['username'] ?? '');
	$password = $_POST['password'] ?? '';
	$remember = isset($_POST['remember']);

	if ($username === '' || $password === '') {
		$errors[] = 'Username dan password wajib diisi.';
	} else {
		$user = verify_user($username, $password);
		if ($user) {
			login_user_session($user);
			if ($remember) create_remember_token((int)$user['id']);
			header('Location: dashboard.php');
			exit;
		} else {
			$errors[] = 'Username atau password salah.';
		}
	}
}
?>
<!doctype html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="assets/styles.css">
	<style>/* fallback small styles if css missing */
	body{font-family:Arial,Helvetica,sans-serif;padding:20px;background:#f5f5f5}
	</style>
</head>
<body>
<div class="login-container">
	<h2>Login</h2>
	<?php if (!empty($errors)): ?>
		<div class="errors">
			<?php foreach ($errors as $e): ?>
				<div class="error"><?php echo htmlspecialchars($e); ?></div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<form method="post" action="login.php">
		<label for="username">Username</label>
		<input id="username" name="username" type="text" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>

		<label for="password">Password</label>
		<input id="password" name="password" type="password" required>

		<label class="remember"><input type="checkbox" name="remember"> Ingat saya</label>

		<button type="submit">Masuk</button>
	</form>
</div>
</body>
</html>

