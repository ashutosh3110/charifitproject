<?php
include "db.php"; // Include your database connection

$sql = "SELECT * FROM donate";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body class="mx-4">

    <h2>Donation Records</h2>
    
    <table >
        <tr >
            <th>id</th>
            <th>Name</th>
            <th>Donate Date</th>
            <th>Donate Amount</th>
            <th>Delete Item</th>
            <th>Upgrade Item</th>
            
            
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['donateDate']}</td>
                        <td>{$row['donateAmount']}</td>
                        <td><a href='delete.php?id=" . urlencode($row['id']) . "' role='button'>Delete</a></td>

                        <td><a href='update.php?id=" . urlencode($row['id']) . "' role='button'>update</a></td>

                        
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }
        ?>
    </table>

    
    <a class="btn btn-primary my-4" href="index.html" role="button">Home</a></div>
    
    

</body>
</html>

<?php
$conn->close();
?>
