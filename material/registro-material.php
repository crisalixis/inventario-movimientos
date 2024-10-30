<?php
    include 'config/db.php';
    if(!empty($_POST)) {
        $alerta='';
        if(empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['cantidad']) || empty($_POST['codigo'])){
            $alerta='<p class="msg-error">No se ingreso ningún dato.</p>';   
        }else{

            $nombre = $_POST['nombre'];
            $descripcion  = $_POST['descripcion'];
            $cantidad  = $_POST['cantidad'];
            $codigo    = $_POST['codigo'];

            $query = mysqli_query($conexion, "INSERT INTO materiales(nombre, descripcion, cantidad, codigo) VALUES('$nombre','$descripcion','$cantidad','$codigo')");

            if($query){
                $alerta='<p class="msg-save">Los datos fueron almacenados correctamente.</p>';  
            }else{
                $alerta='<p class="msg-error">Error al almacenar los datos.</p>';   
            }
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Registro material</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="body-register">
	<section id="container">
		<div class="form-register">
        <div class="alerta"><?php echo isset($alerta) ? $alerta :'' ?></div>
            <h1>Registro material y insumos</h1>
            <hr>
            <form action="" method="post" class="form">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion">
                <label for="cantidad">Cantidad</label>
                <input type="text" name="cantidad" id="cantidad" placeholder="Cantidad">
                <label for="codigo">Codigo</label>
                <input type="text" name="codigo" id="codigo" placeholder="Codigo">
                <input type="submit" value="Crear material" class="btn-save">
            </form>
        </div>
	</section>
</body>
</html>