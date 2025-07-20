<?php 
	include 'config/load_db.php';

	$email = $_POST['email'] ?? '';
	$password = $_POST['password'] ?? '';
	$confirm = $_POST['confirm_password'] ?? '';

	if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password)) {
		die("Password must be at least 8 characters and contain letters and numbers.");
	}

	if ($password !== $confirm) {
		die("Passwords do not match.");
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = $_POST["email"];
		$password = sha1($_POST["password"]);
		$sql = "INSERT INTO `account` (`email`, `password`, `role`) VALUES ('$email', '$password', 'user');";
		if ($conn->query($sql) === TRUE) {
			$url = '../index.php?page=annouce&code=1';
			header('Location: '.$url);
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
    }
?>