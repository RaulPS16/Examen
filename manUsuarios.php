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
    <?php include_once("menu.php"); ?>
    
    <div class="contenedor">
        <h2 class="text-center">Mantenimiento de usuarios</h2>
        <form action="prcManUsuarios.php" method="post">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre del usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control">
            </div>
            <div class="mb-3">
                <label for="clave" class="form-label">Contraseña</label>
                <input type="password" name="clave" id="clave" class="form-control">
            </div>
            <div class="mb-3 form-chek form-switch">
                <input type="checkbox" name="indi_admin" id="indi_admin" class="form-check-input" rol="switch">
                <label for="indi_admin" class="form-check-label">Inidicador de administrador</label>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <input type="submit" value="Consultar" class="btn btn-primary" name="btnConsultar">
                <input type="submit" value="Insertar" class="btn btn-secondary" name="btnInsertar">
                <input type="submit" value="Modificar" class="btn btn-warning" name="btnModificar">
                <input type="submit" value="Eliminar" class="btn btn-danger" name="btnEliminar">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>