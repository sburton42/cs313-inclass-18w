<?php
require("dbConnect.php");

$db = get_db();

$course_id = htmlspecialchars($_GET['course_id']);

$query = "SELECT id, number, name FROM course WHERE id=:course_id";
$stmt = $db->prepare($query);

// Bind any parameters
$stmt->bindValue(":course_id", $course_id, PDO::PARAM_INT);

$stmt->execute();
$course = $stmt->fetch(PDO::FETCH_ASSOC);


$query = "SELECT date, content FROM note WHERE course_id=:course_id";
$stmt = $db->prepare($query);

// Bind any parameters
$stmt->bindValue(":course_id", $course_id, PDO::PARAM_INT);

$stmt->execute();
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Notes</title>
</head>
<body>

<?php
$number = $course['number'];
$name = $course['name'];

	echo "<h1>Notes for $number - $name</h1>";
?>

	<ul>
<?php
	foreach ($notes as $note) {
		$date = $note['date'];
		$content = $note['content'];

		echo "<li><p>$date - '$content'</p></li>";
	}
?>

	</ul>

	<h2>Enter a new note for this course</h2>
	<form method="post" action="insert_note.php">
	<input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
	Date: <input type="date" name="date"><br/>
	Content<br />
	<textarea name="content"></textarea><br/>
	<input type="submit" value="Create Note">
	</form>


</body>
</html>