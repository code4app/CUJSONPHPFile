<?php
header("Content-Type: text/html; charset=UTF-8");

$path = $_GET['path'];
if (empty($path))
{
	die('error path must be set');
}

echo shell_exec('php php_to_json.php '.$path);
