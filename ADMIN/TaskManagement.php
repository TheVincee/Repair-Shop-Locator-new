<?php
require 'config.php'; // Database connection

// Fetch all tasks for an employee
function getTasksByEmployee($employee_id) {
    global $conn;
    $sql = "SELECT * FROM tasks WHERE employee_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Create a new task
function createTask($employee_id, $title, $description, $start_date, $due_date) {
    global $conn;
    $sql = "INSERT INTO tasks (employee_id, title, description, start_date, due_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $employee_id, $title, $description, $start_date, $due_date);
    return $stmt->execute();
}

// Edit a task
function editTask($id, $title, $description, $status, $start_date, $due_date) {
    global $conn;
    $sql = "UPDATE tasks SET title=?, description=?, status=?, start_date=?, due_date=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $title, $description, $status, $start_date, $due_date, $id);
    return $stmt->execute();
}

// Delete a task
function deleteTask($id) {
    global $conn;
    $sql = "DELETE FROM tasks WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Handle form submissions for task creation, updating, or deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Call the appropriate function based on form input
}

?>
