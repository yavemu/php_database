<?php session_start();

	require_once 'config.php';

	if (!empty($_GET["id"])) {
		$sql = "DELETE FROM users WHERE id = :id";

		$query = $pdo->prepare($sql);

		$query->execute([
			'id' => $_GET["id"],
		]);

		$_SESSION['mensaje'] = "Se borro exitosamente el registro";
	}

	header('Location:list.php');

	
?>