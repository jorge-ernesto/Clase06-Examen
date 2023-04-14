<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<?php
$sql = "SELECT * FROM usuarios;";
$resultado = consultar($sql);
//debug_array($resultado);
?>

<!-- CREAR USUARIOS -->
<div>
	<h1>Listar usuarios</h1>
	<p>
        Añade nuevos usuarios.<br>
        <a href="crear-usuarios.php">Crear usuarios</a>
    </p>

    <table border=1>
        <tr>
            <td>ID</td>
            <td>USUARIO</td>
            <td>ESTADO</td>
        </tr>
        <?php foreach($resultado as $value){ ?>
        <tr>
            <td><?=$value['id']?></td>
            <td><?=$value['usuario']?></td>
            <td><?=$value['estado']==1?"Activo":"Desactivado"?></td>
            <td>
                <a href="editar-usuarios.php?id=<?=$value['id']?>">Editar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
			
<?php require_once 'includes/pie.php'; ?>