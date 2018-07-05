<?php

if (!empty($_POST)) {
		
	require_once 'config.php';

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	// sentencia SQL INSERT
	$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";

	$query = $pdo->prepare($sql);


	$result = $query->execute([
        'name' => $name,
        'email' => $email,
        'password' => $password
    ]);

	if ($result) {
		$mensaje = "Se guardo exitosamente.";
	}
	else{
		$mensaje = "Se presento un problema y no se guardo la información.";
	}
}

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
		<h1>Add User</h1>
		<a href="index.php">Home</a>

		<?php if (!empty($mensaje)): ?>
			<div class="row alert alert-success"><?= $mensaje; ?></div>
		<?php endif ?>

		<form action="add.php" method="POST">
			
			<div class="form-group row">
				<label for="name">Name</label>
				<input type="text" required class="form-control form-control-lg" name="name" id="name">
			</div>
			
			<div class="form-group row">
				<label for="email">Email</label>
				<input type="email" required class="form-control form-control-lg" name="email" id="email">
			</div>
			
			<div class="form-group row">
				<label for="password">Password</label>
				<input type="password" required class="form-control form-control-lg" name="password" id="password">
			</div>

			<input type="submit" class="btn btn-primary" value="Save">
			
		</form>
	</div>
</body>
</html>