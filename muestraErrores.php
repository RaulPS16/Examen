<?php
    include_once("ConexionDB.php");

    class muestraErrores extends ConexionDB{
        
        public function __construct($pError){
            parent::__construct();
            $this->buscaError($pError);
        }

        private function buscaError($pError){
            $sql = "SELECT *, COUNT(*) AS contador FROM errores WHERE id = {$pError};";
            if ($pError <> 0) {
                $consultaError = parent::Consultar($sql);
                if ($consultaError[0]["contador"] > 0) {
                    echo '
                    <div class="alert alert-warning alert-dismissible fade show fixed-top" role="alert">
                    <p>' . $consultaError[0]["descripcion"] . '</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }else {
                    echo '
                    <div class="alert alert-warning alert-dismissible fade show fixed-top" role="alert">
                    <p>Ha ocurrido un error inesperado</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            }else {
                echo '
                    <div class="alert alert-success alert-dismissible fade show fixed-top" role="alert">
                    <p>Respuesta satisfactoria</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        }
    }
    

?>