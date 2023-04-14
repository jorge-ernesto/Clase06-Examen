<?php
require_once 'includes/libreria.php';

// Recoger datos del formulario
if(isset($_POST)){

	conectar();
	global $cnx;
	// debug_array($cnx, TRUE);

	// Recoger datos del formulario
	$usuario = isset($_POST['usuario']) ? mysqli_real_escape_string($cnx, $_POST['usuario']) : false;
	$password = isset($_POST['password']) ? mysqli_real_escape_string($cnx, $_POST['password']) : false;
	$estado = isset($_POST['estado']) ? $_POST['estado'] : false;

	// Validación
	$errores = array();
	if(empty($usuario)){
		$errores['usuario'] = 'El usuario no es válido';
	}
	if(empty($password)){
		$errores['password'] = 'El password no es válido';
	}
	if(empty($estado) && !is_numeric($estado)){
		$errores['estado'] = 'El estado no es válido';
	}

	// Encriptamos password
	$password = MD5($password);

	// Guardamos o editamos
	if(count($errores) == 0){
		if(isset($_GET['editar'])){
			$usuario_id = $_GET['editar'];

			$sql = "UPDATE usuarios
					SET usuario='$usuario', clave='$password', estado=$estado
					WHERE id=$usuario_id";
		}else{
			$sql = "INSERT INTO usuarios VALUES(null, '$usuario', '$password', $estado);";
		}
		$guardar = mysqli_query($cnx, $sql);

		header("Location: listar-usuarios.php");
	}else{
		$_SESSION["errores_usuarios"] = $errores;

		if(isset($_GET['editar'])){
			header("Location: editar-usuarios.php?id=".$_GET['editar']);
		}else{
			header("Location: crear-usuarios.php");
		}
	}

	desconectar();

}

