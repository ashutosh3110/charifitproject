<?php
session_start();
include "db.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from database
    $sql = "SELECT * FROM Signup WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['user_name'] = isset($user['firstName']) ? $user['firstName'] . " " . $user['lastName'] : "User";

    
       

       
        header("Location: home.php"); // Redirect to home page
        exit();
    } else {
        echo "<script>alert('Invalid email or password!');</script>";
    }
}

?>