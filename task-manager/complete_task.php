<?php
include 'config.php';

$id = $_GET['id'];

$sql = "UPDATE tasks SET is_completed = TRUE WHERE id = $id";
if(mysqli_query($conn,$sql)){
    header('Location: index.php');
} else {
    echo "Error marking task complete: " . mysqli_error($conn);
}
mysqli_close($conn);
?>