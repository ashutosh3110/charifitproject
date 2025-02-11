<?php
include "db.php"; // Include your database connection

// Check if ID is provided in URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing donation details
    $sql = "SELECT * FROM donate WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc(); // Fetch data
    } else {
        echo "<script>alert('Donation record not found.'); window.location='index.html';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request.'); window.location='index.html';</script>";
    exit();
}

// Handle form submission for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $donate = $_POST['donate'];

    // Update the record
    $update_sql = "UPDATE donate SET name=?, donateDate=?, donateAmount=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssi", $name, $date, $donate, $id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Donation record updated successfully!'); window.location='view.php';</script>";
    } else {
        echo "<script>alert('Error updating record. Please try again.');</script>";
    }

    $update_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Donation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2>Update Donation</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Date:</label>
            <input type="date" class="form-control" name="date" value="<?php echo htmlspecialchars($row['donateDate']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Amount (Rs.):</label>
            <input type="number" class="form-control" name="donate" value="<?php echo htmlspecialchars($row['donateAmount']); ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="index.html" class="btn btn-secondary">Cancel</a>
    </form>

</body>
</html>
