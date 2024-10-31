<?php 
    session_start();
    include "config/db.php";
    
    if(!empty($_POST))
    {
        $alerta='';
        if(empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['categoria']) || empty($_POST['cantidad']) || empty($_POST['codigo'])){
            $alerta='<p class="msg-error">Todos los datos son obligarios.</p>';   
        }else{

            $idmaterial = $_POST['id'];
            $nombre  = $_POST['nombre'];
            $descripcion  = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $cantidad = $_POST['cantidad'];
            $codigo   = $_POST['codigo'];

            $sql_update = mysqli_query($conexion, "UPDATE materiales SET nombre = '$nombre', categoria = '$categoria', descripcion = '$descripcion', cantidad = '$cantidad', codigo = ' $codigo' WHERE idmaterial = $idmaterial");

                if($sql_update > 0){
                    $alerta='<p class="msg-save">Los datos fueron actualizados correctamente.</p>';   
                }else{
                    $alerta='<p class="msg-error">Error al actualizar los datos.</p>';   
                }
    }
    }

    //Mostrar Datos
    $idmaterial = $_GET['id'];

    $sql = mysqli_query($conexion, "SELECT * FROM materiales WHERE id_material = $idmaterial and estado = 1");
    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0){
        header("Location: lista-material.php");
    }else{
        while($data = mysqli_fetch_array($sql)){
            $idmaterial   = $data['id_material'];
            $nombre       = $data['nombre'];
            $descripcion  = $data['descripcion'];
            $categoria    = $data['categoria'];
            $cantidad     = $data['cantidad'];
            $codigo       = $data['codigo'];
        }   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Actualizar datos del material</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="body-register">
	<section id="container">
		<div class="form-register">
            <h1><i class="fas fa-pencil"></i> Actualizar datos</h1>
            <hr>
            <div class="alerta"><?php echo isset($alerta) ? $alerta :'' ?></div>

            <form action="" method="post" class="form">
                <input type="hidden" name="id" value="<?php echo $idmaterial ?>">
                <label for="nombre">Nombre del material</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre del material" value="<?php echo $nombre ?>">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" value="<?php echo $descripcion ?>">
                <label for="categoria">Categoria</label>
                <input type="text" name="categoria" id="categoria" placeholder="Categoria" value="<?php echo $categoria ?>">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" value="<?php echo $cantidad ?>">
                <label for="codigo">Codigo</label>
                <input type="text" name="codigo" id="codigo" placeholder="Codigo" value="<?php echo $codigo ?>">
                <input type="submit" value="Guardar proveedor" class="btn-save">
            </form>
        </div>
	</section>
</body>
</html>