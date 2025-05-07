<?php
include('config.php');

// Get form data
$title = $_POST['title'];
$description = $_POST['description'];
$due_date = $_POST['due_date'];
$priority = $_POST['priority'];

// Debug: Uncomment to see what's being received
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

// Build the SQL query with proper escaping
$sql = "INSERT INTO tasks (title, description, due_date, priority) VALUES (
    '" . mysqli_real_escape_string($conn, $title) . "', 
    " . (!empty($description) ? "'" . mysqli_real_escape_string($conn, $description) . "'" : "NULL") . ",
    " . (!empty($due_date) ? "'" . mysqli_real_escape_string($conn, $due_date) . "'" : "NULL") . ",
    '" . mysqli_real_escape_string($conn, $priority) . "'
)";

// Debug: Uncomment to see the final query
/*
echo "<br>SQL: " . $sql . "<br>";
*/

// Execute query
if (mysqli_query($conn, $sql)) {
    header('Location: index.php');
} else {
    // Show error if query fails
    die("Error: " . mysqli_error($conn));
}
$notification_email = !empty($_POST['notification_email']) ? $_POST['notification_email'] : null;

$sql = "INSERT INTO tasks (title, description, due_date, priority, notification_email) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssss", $title, $description, $due_date, $priority, $notification_email);
?>