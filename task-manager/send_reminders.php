<?php
require 'config.php';

// Find tasks due tomorrow with notification emails
$tomorrow = date('Y-m-d', strtotime('+1 day'));
$result = mysqli_query($conn, "SELECT * FROM tasks WHERE due_date = '$tomorrow' AND is_completed = 0 AND notification_email IS NOT NULL");

while ($task = mysqli_fetch_assoc($result)) {
    $to = $task['notification_email'];
    $subject = "Reminder: " . htmlspecialchars($task['title']) . " is due tomorrow";
    $message = "
        <h2>Task Reminder</h2>
        <p><strong>Task:</strong> " . htmlspecialchars($task['title']) . "</p>
        <p><strong>Description:</strong> " . htmlspecialchars($task['description']) . "</p>
        <p>Due: " . $task['due_date'] . "</p>
        <p>---</p>
        <p><small>You're receiving this because you opted for reminders when creating this task.</small></p>
    ";
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Task Reminder <reminders@yourdomain.com>\r\n";
    
    mail($to, $subject, $message, $headers);
}

// Log execution (optional)
file_put_contents('reminders.log', date('Y-m-d H:i:s') . " - Sent reminders\n", FILE_APPEND);
?>