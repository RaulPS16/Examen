<!DOCTYPE html>
<html lang="en">
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
    include_once("muestraTablas.php");
    if (isset($_GET['error']) ) {
		$muestraErrores = new muestraErrores($_GET['error']);
	}
    $placa = '';
    $fecha_consulta = '';
    if (isset($_POST["placa"]) || isset($_POST["fecha_consulta"])) {
        $placa = $_POST["placa"];
        $fecha_consulta = $_POST["fecha_consulta"];

    }
    ?>
    
    <div class="contenedor">
        <h2 class="text-center">Registro de parqueo</h2>
        <form action="conRegistroParqueo.php" method="post">
            <div class="mb-3">
                <label for="fecha_consulta" class="form-label">Fecha</label>
                <input type="date" name="fecha_consulta" id="fecha_consulta" class="form-control">
            </div>
            <div class="mb-3">
                <label for="placa" class="form-label">Placa</label>
                <input type="text" name="placa" id="placa" class="form-control">
                <div class="invalid-feedback">Ingrese una placa</div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <input type="submit" value="Consultar" class="btn btn-primary" name="btnConsultar">
            </div>
        </form>

        <?php $tabla = new muestraTablas($fecha_consulta,$placa); ?>
        
    </div>
    <script type="text/javascript" src="js/validaForms.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>