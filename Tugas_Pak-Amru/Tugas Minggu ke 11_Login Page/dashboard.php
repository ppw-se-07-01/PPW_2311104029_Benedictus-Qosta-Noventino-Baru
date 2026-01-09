<?php
require_once __DIR__ . '/helpers.php';
ensure_logged_in();
$username = $_SESSION['username'] ?? 'User';
?>
<!doctype html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" href="assets/styles.css">
	<style>body{font-family:Arial,Helvetica,sans-serif;padding:20px}</style>
</head>
<body>
	<div class="container">
		<h1>Halo, <?php echo htmlspecialchars($username); ?></h1>
		<p>Selamat datang di dashboard.</p>
		<p><a href="logout.php">Logout</a></p>
	</div>
</body>
</html>

