<?php
require("dbConnect.php");

$db = get_db();

$query = "SELECT id, number, name FROM course";
$stmt = $db->prepare($query);
// Bind any parameters

$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Courses</title>
</head>
<body>
	<h1>Courses</h1>

	<ul>
<?php
	foreach ($courses as $course) {
		$id = $course['id'];
		$number = $course['number'];
		$name = $course['name'];
		
		echo "<li><p><a href='notes.php?course_id=$id'>$number - $name</a></p></li>\n";
	}
?>


	</ul>


</body>
</html>