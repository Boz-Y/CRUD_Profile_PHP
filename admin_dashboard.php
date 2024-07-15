<?php session_start(); ?>

<?php
if (!isset($_SESSION['valid']) || $_SESSION['role'] !== 'admin') {
	header('Location: login.php');
	exit();
}

include_once("connection.php");

$result = mysqli_query($mysqli, "SELECT id, username, email, role FROM login WHERE role != 'admin'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<h2>Admin Dashboard</h2>
	<a href="logout.php" class="btn btn-link">Logout</a>
	<br/><br/>

	<table class="table table-striped">
		<thead class="thead-dark">
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
		</thead>
		<tbody>
		<?php while ($row = mysqli_fetch_assoc($result)): ?>
			<tr>
				<td><?= $row['id']; ?></td>
				<td><?= $row['username']; ?></td>
				<td><?= $row['email']; ?></td>
				<td><?= $row['role']; ?></td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
