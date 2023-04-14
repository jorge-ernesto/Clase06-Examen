<?php

require_once('config.php');

$cnx='';

# FUNCIONES DE CONEXION
function conectar()
{
    #conectarser a la BD
    global $cnx;
    $cnx=mysqli_connect(HOST, USER, PASS, BASE, PORT);
    mysqli_query($cnx, 'set names utf8');
}
function desconectar()
{
    #desconectare de la BD
    global $cnx;
    mysqli_close($cnx);
}
function consultar($sql)
{
    # SELECT | Trae datos
    global $cnx;
    conectar();

    $caja=mysqli_query($cnx, $sql);

    # pasar la caja a una estructura
    $datos=array();
    while ($fila=mysqli_fetch_assoc($caja)) {
        $datos[]=$fila;
    }
    desconectar();
    return $datos;
}
function ejecutar($sql)
{
    # INSERT, UPDATE, DELETE
    # No trae datos

    global $cnx;
    conectar();
    $exito=mysqli_query($cnx, $sql);
    desconectar();
    //return $exito ? 1 : 0;
    if ($exito) {
        return 1;
    } else {
        return 0;
    }
}

# FUNCIONES HELPER
function debug_array($array, $die=FALSE)
{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	if($die==TRUE){
		die();
	}
}
function mostrarError($errores, $campo)
{
	$alerta = '';
	if(isset($errores[$campo]) && !empty($campo)){
		$alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
	}

	return $alerta;
}
function borrarErrores()
{
	$borrado = false;

	if(isset($_SESSION['errores'])){
		$_SESSION['errores'] = null;
		$borrado = true;
	}

	if(isset($_SESSION['errores_usuarios'])){
		$_SESSION['errores_usuarios'] = null;
		$borrado = true;
	}

	if(isset($_SESSION['errores_personas'])){
		$_SESSION['errores_personas'] = null;
		$borrado = true;
	}

    if(isset($_SESSION['errores_cursos'])){
		$_SESSION['errores_cursos'] = null;
		$borrado = true;
	}

    if(isset($_SESSION['errores_alumnos'])){
		$_SESSION['errores_alumnos'] = null;
		$borrado = true;
	}

	if(isset($_SESSION['errores_notas'])){
		$_SESSION['errores_notas'] = null;
		$borrado = true;
	}

    if(isset($_SESSION['completado'])){
		$_SESSION['completado'] = null;
		$borrado = true;
	}

	return $borrado;
}

// Iniciar la sesión
if(!isset($_SESSION)){
	session_start();
}