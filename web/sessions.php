<?php
session_start();

$user = $_SESSION["user"];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sessions</title>
</head>
<body>

	<p>Thank you for continuing to browse <?php echo $user; ?></p>

</body>
</html>