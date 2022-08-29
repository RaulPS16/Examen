<?php
    session_start();
    include_once("loginControl.php");
    $login = new loginControl();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos-propios.css">

    <title>Registro de parqueo</title>
</head>
<body>
    <?php 
    include_once("menu.php"); 
    include_once("muestraErrores.php");
    include_once("prcSelect.php");

    $retornaDatos = array("descripcion_tarifa" => "",
    "tarifa" => "",
    "descuento" => "",
    "descuento" => "",
    "placa" => "",
    "horas_parqueo" => "",
    "monto_pagar" => "");

    if (isset($_GET['error']) ) {
		$muestraErrores = new muestraErrores($_GET['error']);
	}

    if (isset($_GET['datosConsulta'])) {
        $retornaDatos = unserialize($_GET['datosConsulta']);
    }
    ?>
    <div class="contenedor">
        <h2 class="text-center">Registro de parqueo</h2>
        <form action="prcRegistroParqueo.php" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="placa" class="form-label">Numero de Placa</label>
                <input type="text" name="placa" id="placa" class="form-control" value="<?php print_r($retornaDatos["placa"]); ?>" required>
                <div class="invalid-feedback">Ingrese una placa</div>
            </div>
            <div class="mb-3">
                <label for="horas_parqueo" class="form-label">Horas Parqueo</label>
                <input type="text" name="horas_parqueo" id="horas_parqueo" class="form-control" value="<?php print_r($retornaDatos["horas_parqueo"]); ?>">
            </div>
            <div class="mb-3">
                <label for="monto_tarifa" class="form-label">Monto Tarifa</label>
                <div class="input-group">
                    <spam class="input-group-text" id="basic-addon">₡</spam>
                    <?php $tarifa = new selectTarifas($retornaDatos["tarifa"]); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="descuento" class="form-label">Descuento</label>
                <div class="input-group">
                    <?php $descuento = new selectDescuentos($retornaDatos["descuento"]); ?>
                    <spam class="input-group-text" id="basic-addon2">%</spam>
                </div>
            </div>
            <div class="mb-3">
                <label for="monto_pagar" class="form-label">Monto a pagar</label>
                <div class="input-group">
                    <spam class="input-group-text" id="basic-addon">₡</spam>
                    <input type="text" name="monto_pagar" id="monto_pagar" class="form-control" aria-describedby="basic-addon" value="<?php print_r($retornaDatos["monto_pagar"]); ?>">
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <input type="submit" value="Ingreso" class="btn btn-primary" name="btnRegistroParqueo">
                <input type="submit" value="Calcular monto" class="btn btn-warning" name="btnRegistroParqueo">
                <input type="submit" value="Salida" class="btn btn-secondary" name="btnRegistroParqueo">
            </div>
        </form>
    </div>
    <script type="text/javascript" src="js/validaForms.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>