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

$stmt = $db->prepare('SELECT id, title, year, rating FROM movie');
$stmt->execute();
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
foreach ($movies as $movie)
{
	$id = $movie["id"];
	$title = $movie["title"];
	$year = $movie["year"];
	echo "<li><p><a href='movieDetails.php?movieId=$id'>$title</a> ($year)</p></li>";
}
?>
	</ul>
</body>
</html>