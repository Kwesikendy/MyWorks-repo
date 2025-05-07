<?php 
include 'config.php';

mysqli_query($conn, "DELETE FROM tasks WHERE is_completed = TRUE");
header('Location: index.php');
?>