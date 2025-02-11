<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $donate = $_POST['donate'];
    // Insert new user
    $sql = "INSERT INTO donate (name,donateDate,donateAmount) VALUES ( ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $date, $donate);

    if ($stmt->execute()) {
        echo "<script>alert('Donate successful!'); window.location='index.html';</script>";
    } else {
        echo "<script>alert('Error: Something went wrong. Please try again.');</script>";
    }

$check_stmt->close();
$stmt->close();
}
$conn->close();
?>