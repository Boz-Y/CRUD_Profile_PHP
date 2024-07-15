<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <a href="index.php" class="btn btn-link">Home</a>
    <br />
    <?php
    include("connection.php");

    if (isset($_POST['submit'])) {
        $user = mysqli_real_escape_string($mysqli, $_POST['username']);
        $pass = mysqli_real_escape_string($mysqli, $_POST['password']);

        if ($user == "" || $pass == "") {
            echo "<div class='alert alert-danger'>Either username or password field is empty.</div>";
            echo "<a href='login.php' class='btn btn-warning'>Go back</a>";
        } else {
            $result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user' AND password=md5('$pass')")
            or die("Could not execute the select query.");

            $row = mysqli_fetch_assoc($result);

            if (is_array($row) && !empty($row)) {
                $validuser = $row['username'];
                $_SESSION['valid'] = $validuser;
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
            } else {
                echo "<div class='alert alert-danger'>Invalid username or password.</div>";
                echo "<a href='login.php' class='btn btn-warning'>Go back</a>";
            }

            if (isset($_SESSION['valid'])) {
                header('Location: index.php');
            }
        }
    } else {
    ?>
    <h2>Login</h2>
    <form name="form1" method="post" action="">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    <?php
    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
