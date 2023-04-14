<?php
require_once 'includes/libreria.php';

// Recoger datos del formulario
if(isset($_POST)){

	// Recoger datos del formulario
	$usuario = $_POST['usuario'];
	$password = MD5($_POST['password']);

	// Consulta para comprobar las credenciales del usuario
	$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND estado = 1;";
	$resultado = consultar($sql);
	$usuario = $resultado[0];

	if (isset($usuario['clave']) && count($resultado) == 1) {
		// Comprobar la contraseña
		if ($password == $usuario['clave']) {
			// Utilizar una sesión para guardar los datos del usuario logueado
			$_SESSION['usuario'] = $usuario;

		} else {
			// Si algo falla enviar una sesión con el fallo
			$_SESSION['error_login'] = "Login incorrecto!!";
		}
	} else {
		// mensaje de error
		$_SESSION['error_login'] = "Login incorrecto!!";
	}

}

// Redirigir al index.php
header('Location: index.php');