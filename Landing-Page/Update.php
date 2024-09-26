<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "ratings_db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = intval($_POST['rating']);
    $comment = $mysqli->real_escape_string($_POST['comment']);

    // Insert user rating into the database
    $stmt = $mysqli->prepare("INSERT INTO ratings (user_id, rating, comment) VALUES (?, ?, ?)");
    $user_id = 1; // Replace with actual user ID if logged in
    $stmt->bind_param("iis", $user_id, $rating, $comment);
    if ($stmt->execute()) {
        echo "Rating submitted!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$mysqli->close();
?>
