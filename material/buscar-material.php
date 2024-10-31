<?php
    include "config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Lista de materiales</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<section id="container">
		<?php

            $busqueda = strtolower($_REQUEST['busqueda']);
            if(empty($busqueda)){
                header("Location: lista-materiales.php");
            }
        ?>
<h1><i class="fas fa-user-group"></i> Lista de materiales</h1>
        <a href="registro-material.php" class="btn-new"><i class="fa-solid fa-user-plus"></i> Agregar material/insumo</a>
        <form action="buscar-material.php" method="get" class="form-search">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
            <input type="submit" value="Buscar" class="btn-search">
        </form> 
        <table>
            <tr>
                <th>Id Material</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Cantidad</th>
                <th>Codigo</th>
                <th>Fecha de ingreso</th>
                <th>Acciones</th>
            </tr>
            <?php 
                $query = mysqli_query($conexion, "SELECT * FROM materiales WHERE (id_material LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR codigo LIKE '%$busqueda%'  OR fecha_ingreso LIKE '%$busqueda%') AND estado = 1 ORDER BY id_material ASC");

                $result = mysqli_num_rows($query);

                if($result > 0){
                    while ($data = mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $data['id_material'] ?></td>
                            <td><?php echo $data['nombre'] ?></td>
                            <td><?php echo $data['descripcion'] ?></td>
                            <td><?php echo $data['categoria'] ?></td>
                            <td><?php echo $data['cantidad'] ?></td>
                            <td><?php echo $data['codigo'] ?></td>
                            <td><?php echo $data['fecha_ingreso'] ?></td>
                            <td>
                                <a href="editar-material.php?id=<?php echo $data['id_material'] ?>" class="link-edit"> Editar</a>
                                <a href="eliminar-material.php?id=<?php echo $data['id_material'] ?>" class="link-delete"> Eliminar</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
        </table>
    </section>
</body>
</html>