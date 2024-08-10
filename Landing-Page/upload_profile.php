<?php
// Include the database connection file
require 'dbconfig.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    // Handle the file upload
    $profile_picture = '';
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["profilePicture"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFilePath)) {
                $profile_picture = $targetFilePath;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
            exit;
        }
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO user_profiles (email, password, address, address2, city, state, zip, profile_picture)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssssssss", $email, $password, $address, $address2, $city, $state, $zip, $profile_picture);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Profile saved successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
    }

    // Close connection
    $conn->close();
}
?>
