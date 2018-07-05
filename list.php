<?php
	require_once 'config.php';
	$queryResult = $pdo->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Curso PHP - Base de datos</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

</head>
<body>
	<div class="container">
		<h1>List Users</h1>
		<a href="index.php">Home</a>

		<table class="table table-light table-hover table-bordered">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
				</tr>
			</thead>
			<tbody>
<?php foreach ($queryResult->fetchAll() as $key => $row): ?>
	<tr>
		<th scope="row"><?= $key+1; ?></th>
		<td><?= $row['name']; ?></td>
		<td><?= $row['email']; ?></td>
	</tr>
<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>