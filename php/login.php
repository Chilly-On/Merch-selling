<?php 
	session_start();
	include 'config/load_db.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = $_POST["email"];
		$password = sha1($_POST["password"]);
		$sql = "SELECT * FROM account WHERE email = '$email' AND password = '$password';";
		$query = $conn->query($sql);
		if ($query->num_rows) {
			$_SESSION['email'] = $email;
			$_SESSION['role'] = $query->fetch_assoc()['role'];
			$url = '../index.php';
			header('Location: '.$url);
		} else {
		    $url = '../index.php?page=login&attempt=1';
			header('Location: '.$url);
		}
    }
?>