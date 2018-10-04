<?php
	session_start();
	require "../model/database.php";
	if($stmt = $mysqli->prepare("SELECT motorista.codigo, motorista.sobrenome, motorista.nivel FROM motorista WHERE motorista.usuario = ? AND motorista.senha = ?")){
		$pass = md5($_POST['senha']);
		$stmt->bind_param('ss', $_POST['usuario'], $pass);
		$stmt->bind_result($codigo, $sobrenome, $nivel);
		if($stmt->execute()){
			$stmt->fetch();
			$_SESSION['logged'] = $codigo;
			$_SESSION['sobrenome'] = $sobrenome;
			$_SESSION['nivel'] = $nivel;
		}
	}
	header("Location: ../view/www/intern.php");
?>