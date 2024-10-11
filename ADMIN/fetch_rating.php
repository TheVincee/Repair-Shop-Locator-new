<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'repair-shop-locator';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch reviews
$query = "SELECT * FROM review_table ORDER BY review_id DESC";
$result = $conn->query($query);

$output = '';

// Check if there are reviews
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userName = htmlspecialchars($row['user_name']);
        $userReview = htmlspecialchars($row['user_review']);
        $userRating = isset($row['user_rating']) ? htmlspecialchars($row['user_rating']) : 'N/A';
        $dateTime = htmlspecialchars($row['datetime']);

        $output .= '
            <div class="review">
                <h5>' . $userName . '</h5>
                <p>' . $userReview . '</p>
                <h6>Rating: ' . $userRating . ' / 5</h6>
                <p><small>Reviewed on: ' . $dateTime . '</small></p>
                <hr>
            </div>
        ';
    }
} else {
    $output .= '<h5 class="text-danger">No Reviews Found</h5>';
}

echo $output;

// Close connection
$conn->close();
?>
