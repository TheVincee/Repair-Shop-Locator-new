<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$username = "root";
$password = "";
$dbname = "repair-shop-locator";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if ($conn == false) {
    die("Connection problem: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user_pass WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Check if any row is returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Debug: Output the email and password from the database
        echo "Debug: Email from DB: " . htmlspecialchars($row['email']) . "<br>";
        echo "Debug: Password from DB: " . htmlspecialchars($row['password']) . "<br>";
        echo "Debug: User type from DB: " . htmlspecialchars($row['usertype']) . "<br>";

        // Check user type and verify password accordingly
        if ($row["usertype"] == "admin") {
            // Admin passwords are in plain text (not recommended in production)
            if ($password === $row['password']) {
                // Start session and store user data
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['usertype'] = $row['usertype'];

                // Redirect to admin dashboard
                header("Location: /REPAIRSHOP-LOCATOR-REVISE/ADMIN/Dashboard.php");
                exit();
            } else {
                echo "Password verification failed. Invalid email or password.";
            }
        } else {
            // Regular user passwords are hashed
            if (password_verify($password, $row['password'])) {
                // Start session and store user data
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['usertype'] = $row['usertype'];

                // Redirect to user home page
                header("Location: /REPAIRSHOP-LOCATOR-REVISE/Landing-Page/Home.php");
                exit();
            } else {
                echo "Password verification failed. Invalid email or password.";
            }
        }
    } else {
        // No user found with this email
        echo "No user found with this email. Invalid email or password.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
