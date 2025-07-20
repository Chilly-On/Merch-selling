<?php
	session_start();
	session_unset();
	$url = '../index.php';			// Redirect to home
	header('Location: '.$url);
?>