<?php 

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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user_pass WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);

    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Check if any row is returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Check user type and redirect accordingly
        if ($row["usertype"] == "user") {
            header("Location: /REPAIRSHOP-LOCATOR-REVISE/Landing-Page/Home.php");
            exit();
        } elseif ($row["usertype"] == "admin") {
            header("Location: /REPAIRSHOP-LOCATOR-REVISE/ADMIN/Dashboard.php");
            exit();
        } else {
            echo "Invalid user type.";
        }
    } else {
        echo "Invalid email or password.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();

?>
