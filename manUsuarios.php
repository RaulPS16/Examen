<?php
    session_start();
    include_once("loginControl.php");
    $login = new loginControl();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos-propios.css">

    <title>Mantenimiento de usuarios</title>
</head>
<body>
    <?php 
    include_once("menu.php"); 
    include_once("muestraErrores.php");
    $retornaDatos = array(array("id_usuario" => "",
    "clave" => "",
    "indi_admin" => 0));
    if (isset($_GET['datosConsulta'])) {
        $retornaDatos = unserialize($_GET['datosConsulta']);
    }
    if (isset($_GET['error']) ) {
		$muestraErrores = new muestraErrores($_GET['error']);
	}
    
    ?>
    
    <div class="contenedor">
        <h2 class="text-center">Mantenimiento de usuarios</h2>
        <form action="prcManUsuarios.php" method="post">
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Nombre del usuario</label>
                <input type="text" name="id_usuario" id="id_usuario" class="form-control" value="<?php print_r($retornaDatos[0]['id_usuario']);?>" placeholder="Nombre">
            </div>
            <div class="mb-3">
                <label for="clave" class="form-label">Contraseña</label>
                <input type="password" name="clave" id="clave" class="form-control" value="<?php print_r($retornaDatos[0]['clave']);?>">
            </div>
            <div class="mb-3 form-chek form-switch">
                <?php
                    if ($retornaDatos[0]["indi_admin"] == 1) {
                        ?>
                        <input type="checkbox" name="indi_admin" id="indi_admin" class="form-check-input" rol="switch" checked>
                        <?php
                    }else {
                        ?>
                        <input type="checkbox" name="indi_admin" id="indi_admin" class="form-check-input" rol="switch">
                        <?php
                    }
                ?>
                <label for="indi_admin" class="form-check-label">Inidicador de administrador</label>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <input type="submit" value="Consultar" class="btn btn-primary" name="btnManUsuarios">
                <input type="submit" value="Insertar" class="btn btn-secondary" name="btnManUsuarios">
                <input type="submit" value="Modificar" class="btn btn-warning" name="btnManUsuarios">
                <input type="submit" value="Eliminar" class="btn btn-danger" name="btnManUsuarios">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>