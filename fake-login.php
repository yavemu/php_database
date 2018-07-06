<?php

$user = null;
$query = null;

if (!empty($_POST)) {
    require_once 'config.php';

    ###########################################################################################################
    // Query que permite realizar inyeccion a la BD,

    	$query = "SELECT * FROM users WHERE email = ".$_POST['email']." AND password = ".md5($_POST['password'];
    	$queryResult = $pdo->query($query);
    	$queryResult->fetch(PDO::FETCH_ASSOC);

    // Errores:
    // 	* Ingresar directamente los valores a la sentencia, como se observa en la variable query
    // 	* No utilizar prepare en el $queryResult = $pdo->query($query);
    ###########################################################################################################
    

    $query = "SELECT * FROM users WHERE email = :email AND password = :password";
    $prepared = $pdo->prepare($query);
    $prepared->execute([
        'email' => $_POST['email'],
        'password' => md5($_POST['password'])
    ]);

    $user = $prepared->fetch(PDO::FETCH_ASSOC);
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
    <h1>Fake Login</h1>
    <a href="index.php">Home</a>
    
    	<form action="update.php" method="POST">
    		
    		<div class="form-group row">
				<label for="email">Email</label>
				<input type="email" required class="form-control form-control-lg" name="email" id="email">
			</div>
			
			<div class="form-group row">
				<label for="password">Password</label>
				<input type="password" required class="form-control form-control-lg" name="password" id="password">
			</div>

    		<input type="submit" class="btn btn-primary" value="Login">
    		
    	</form>

    <h2>Query</h2>
    <div>
        <?php print_r($query); ?>
    </div>
    <h2>User Data</h2>
    <div>
        <?php print_r($user); ?>
    </div>
</div>
</body>
</html>