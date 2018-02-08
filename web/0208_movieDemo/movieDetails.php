<?php

try
{
  $user = 'movieapp';
  $password = 'jeff';
  $db = new PDO('pgsql:host=localhost;dbname=movies', $user, $password);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

$movieId = $_GET["movieId"];

$stmt = $db->prepare('SELECT name FROM actor a JOIN movieActor ma ON a.id = ma.actorId JOIN movie m ON ma.movieId = m.id WHERE m.id=:theid');
$stmt->bindValue(':theid', $movieId, PDO::PARAM_INT);
$stmt->execute();
$actors = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Movies</title>
</head>
<body>
	<h1>Movies</h1>

	<ul>

<?php
foreach ($actors as $actor)
{
	$name = $actor["name"];
	echo "<li><p>$name</p></li>";
}
?>

	</ul>
</body>
</html>