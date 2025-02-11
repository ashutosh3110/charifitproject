<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "charity";


// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get Form Data
$email = htmlspecialchars($_POST['email'], FILTER_SANITIZE_EMAIL);
$query = filter_var($_POST['query']);

// Insert into Database
$sql = "INSERT INTO contact (email,query) VALUES ('$email', '$query')";

if ($conn->query($sql) === TRUE) {
    echo "Data saved successfully!";
    header("Location: index.html?message=success");
exit(); 
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>
