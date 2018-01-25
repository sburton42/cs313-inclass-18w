<?php
$username = htmlspecialchars($_REQUEST['username']);

session_start();
$_SESSION["user"] = $username;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
</head>
<body>

	<h2>Welcome <?php echo $username; ?></h2>

<?php
	echo "<h2>Welcome " . $username . "</h2>";
?>

	<p>Browse other pages on our site: <a href="sessions.php">click here</a></p>

</body>
</html>