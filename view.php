<?php session_start(); ?>
<?php
if (!isset($_SESSION['valid'])) {
    header('Location: login.php');
}
?>
<?php
include_once("connection.php");
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE login_id=" . $_SESSION['id'] . " ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <a href="index.php" class="btn btn-link">Home</a> | <a href="add.php" class="btn btn-link">Add New Data</a> | <a href="logout.php" class="btn btn-link">Logout</a>
    <br/><br/>
    <h2>View Products</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price (Dinar)</th>
                <th>Image</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($res = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $res['name'] . "</td>";
            echo "<td>" . $res['qty'] . "</td>";
            echo "<td>" . $res['price'] . "</td>";
            echo "<td><img src='uploads/" . $res['image'] . "' alt='" . $res['name'] . "' width='100'></td>";
            echo "<td><a href=\"edit.php?id=$res[id]\" class=\"btn btn-warning btn-sm\">Edit</a> | <a href=\"delete.php?id=$res[id]\" class=\"btn btn-danger btn-sm\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
