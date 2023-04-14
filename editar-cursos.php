<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<?php
	//REDIRECCION EN CASO NO EXISTA EL CURSO
	$id = $_GET['id'];
	$sql = "SELECT * FROM cursos WHERE id = $id;";
	$resultado = consultar($sql);
	$curso_actual = $resultado[0];
	//debug_array($persona_actual);

	if(!isset($curso_actual['id'])){
		header("Location: index.php");
	}

	//OBTENEMOS ESTADOS
	$estado = array(
		1 => "Activo",
		0 => "Desactivado"
	);
?>

<!-- CREAR USUARIOS -->
<div>
	<h1>Editar usuarios</h1>
	<p>Editar usuarios.</p>

	<?php echo isset($_SESSION['errores_usuarios']) ? mostrarError($_SESSION['errores_usuarios'], 'usuario') : ''; ?>
	<?php echo isset($_SESSION['errores_usuarios']) ? mostrarError($_SESSION['errores_usuarios'], 'password') : ''; ?>
	<?php echo isset($_SESSION['errores_usuarios']) ? mostrarError($_SESSION['errores_usuarios'], 'estado') : ''; ?>

	<form action="guardar-cursos.php?editar=<?=$curso_actual['id']?>" method="POST">
		<label>Usuario:</label>
		<input type="text" name="nombre" value="<?=$curso_actual['nombre']?>"><br>

		<label>Contraseña:</label>
		<input type="text" name="codigo" value="<?=$curso_actual['codigo']?>"><br>

		<label>Estado:</label>
		<select name="estado">
			<?php foreach($estado as $key => $value){ ?>
			<?php $selected = ($key == $curso_actual['estado']) ? "selected" : ""; ?>
			<option value="<?=$key?>" <?=$selected?> ><?=$value?></option>
			<?php } ?>
		</select><br>

		<input type="submit" value="Editar">
		<a href="listar-cursos.php">Atras</a>
	</form>
	<?php borrarErrores(); ?>
</div>

<?php require_once 'includes/pie.php'; ?>