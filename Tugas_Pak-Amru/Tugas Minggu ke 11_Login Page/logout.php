<?php
require_once __DIR__ . '/helpers.php';
logout_user();
header('Location: login.php');
exit;

