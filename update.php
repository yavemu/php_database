<?php

	require_once 'config.php';

	if (!empty($_GET["id"])) {
		$sql = "SELECT * FROM users WHERE id = :id";

		$query = $pdo->prepare($sql);

		$query->execute([
			'id' => $_GET["id"],
		]);

		$row = $query->fetch(PDO::FETCH_ASSOC);
	}else{

		if (!empty($_POST['update'])) 
		{
			//$row para mantener las variables visibles en el formulario
			$row = $_POST;

			$id = $_POST['id'];
			$name = $_POST['name'];
			$email = $_POST['email'];

			$sql = "UPDATE users SET name=:name, email=:email WHERE id=:id";

			$query = $pdo->prepare($sql);

			$result = $query->execute([
		        'name' => $name,
		        'email' => $email,
		        'id' => $id
		    ]);

			if ($result) {
				$mensaje = "Se realizó exitosamente la actualización de los datos.";
			}
			else{
				$mensaje = "Se presento un problema y no se actualizo la información.";
			}
		}
		else{
			$mensaje = "Información incompleta.";
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
		<h1>Update User</h1>
		<a href="index.php">Home</a>
		<a href="list.php">Back</a>

		<?php if (!empty($mensaje)): ?>
			<div class="row alert alert-success"><?= $mensaje; ?></div>
		<?php endif ?>

		<?php if (!empty($row['id'])): ?>
			<form action="update.php" method="POST">
				
				<div class="form-group row">
					<label for="name">Name</label>
					<input type="text" required class="form-control form-control-lg" value="<?= $row['name'] ?>" name="name" id="name">
				</div>
				
				<div class="form-group row">
					<label for="email">Email</label>
					<input type="email" required class="form-control form-control-lg" value="<?= $row['email'] ?>" name="email" id="email">
				</div>

				<input type="submit" class="btn btn-primary" value="Update" name="update">
				<input type="hidden" name="id" value="<?= $row['id'] ?>">
				
			</form>
		<?php endif ?>

	</div>
</body>
</html>