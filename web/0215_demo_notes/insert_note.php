<?php
require("dbConnect.php");

$db = get_db();

$course_id = htmlspecialchars($_POST['course_id']);
$date = htmlspecialchars($_POST['date']);
$content = htmlspecialchars($_POST['content']);

// var_dump($course_id);
// var_dump($date);
// var_dump($content);

$query = "INSERT INTO note(course_id, date, content) VALUES (:course_id, :date, :content)";

$stmt = $db->prepare($query);

// Bind any parameters
$stmt->bindValue(":course_id", $course_id, PDO::PARAM_INT);
$stmt->bindValue(":date", $date, PDO::PARAM_STR);
$stmt->bindValue(":content", $content, PDO::PARAM_STR);

try {
	// SB: This was silently failing on me a lot, so to help debug it, I put it inside a try catch block. It was generating an exception, and it helped me track down my problem.
	$stmt->execute();

} catch (Exception $ex) {
	// If this were in production, you would not want to echo
	// the details of the exception.
	echo "Error connecting to DB. Details: $ex";
	var_dump($ex);
	die();
} 


$notes_page = "notes.php?course_id=$course_id";
header("Location: $notes_page");
die();

?>