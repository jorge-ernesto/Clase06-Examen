<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<?php
$sql = "SELECT * FROM valumnos;";
$resultado = consultar($sql);
// debug_array($resultado);
?>

<!-- CREAR PERSONAS -->
<div>
	<h1>Listar personas</h1>
	<p>
        Añade nuevas personas.<br>
        <a href="crear-personas.php">Crear personas</a>
    </p>

    <table border=1>
        <tr>
            <td>ID</td>
            <td>PATERNO</td>
            <td>MATERNO</td>
            <td>NOMBRE</td>
            <td>GENERO</td>
            <td>DOCUMENTO</td>
            <td>NUMERO DE DOCUMENTO</td>
            <td>CORREO</td>
            <td></td>
        </tr>
        <?php foreach($resultado as $value){ ?>
        <tr>
            <td><?=$value['id']?></td>
            <td><?=$value['paterno']?></td>
            <td><?=$value['materno']?></td>
            <td><?=$value['nombre']?></td>
            <td><?=$value['genero']?></td>
            <td><?=$value['codigo']?></td>
            <td><?=$value['docu_num']?></td>
            <td><?=$value['correo']?></td>
            <td>
                <a href="editar-personas.php?id=<?=$value['id']?>">Editar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
			
<?php require_once 'includes/pie.php'; ?>