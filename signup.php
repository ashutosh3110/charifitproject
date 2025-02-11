<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first'];
    $lastName = $_POST['last'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password

    // Check if the email already exists
    $check_sql = "SELECT email FROM Signup WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "<script>alert('Error: Email already exists! Please use another email.'); window.location='signup.html';</script>";
    } else {
        // Insert new user
        $sql = "INSERT INTO Signup (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Signup successful! Please login.'); window.location='index.html';</script>";
        } else {
            echo "<script>alert('Error: Something went wrong. Please try again.');</script>";
        }
    }
    $check_stmt->close();
    $stmt->close();
}
$conn->close();
?>