<?php
include "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare the delete statement
    $sql = "DELETE FROM donate WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Donation record deleted successfully!'); window.location='view.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to delete record. Please try again.'); window.location='view.php';</script>";
    }
    
    $stmt->close();
} else {
    echo "<script>alert('Invalid request.'); window.location='view.php';</script>";
}

$conn->close();
?>
