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

    <title>Mantenimiento de descuentos</title>
</head>
<body>
    <?php 
    include_once("menu.php"); 
    include_once("muestraErrores.php");
    
    $retornaDatos = array(array("descripcion" => "",
    "descuento" => ""));

    if (isset($_GET['error']) ) {
		$muestraErrores = new muestraErrores($_GET['error']);
	}
    if (isset($_GET['datosConsulta'])) {
        $retornaDatos = unserialize($_GET['datosConsulta']);
    }
    ?>
    
    <div class="contenedor">
        <h2 class="text-center">Mantenimiento de descuentos</h2>
        <form action="prcManDescuento.php" method="post">
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php print_r($retornaDatos[0]["descripcion"]);?>">
            </div>
            <div class="mb-3">
                <label for="descuento" class="form-label">Descuento</label>
                <div class="input-group">
                    <input type="number" name="descuento" id="descuento" class="form-control" aria-describedby="basic-addon" step="0.01" value="<?php print_r($retornaDatos[0]["descuento"]);?>">
                    <spam class="input-group-text" id="basic-addon">%</spam>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <input type="submit" value="Consultar" class="btn btn-primary" name="btnManDescuento">
                <input type="submit" value="Insertar" class="btn btn-secondary" name="btnManDescuento">
                <input type="submit" value="Modificar" class="btn btn-warning" name="btnManDescuento">
                <input type="submit" value="Eliminar" class="btn btn-danger" name="btnManDescuento">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>