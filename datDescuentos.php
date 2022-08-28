<?php
    include_once("ConexionDB.php");

    class datDescuentos extends ConexionDB{
        
        public function __construct(){
            parent::__construct();
        }

        public function insertar($pValores){
            try {
                $sql = "INSERT INTO descuentos VALUES (NULL, '{$pValores['descripcion']}', {$pValores['descuento']});";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo insertar " . $th->getMessage);
            }
            
        }

        public function modificar($pValores){
            try {
                $sql = "UPDATE descuentos SET descripcion = '{$pValores['descripcion']}', descuento =  {$pValores['descuento']} WHERE descripcion = '{$pValores['descripcion']}';";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo modificar " . $th->getMessage);
            }
        }

        public function eliminar($pValores){
            try {
                $sql = "DELETE FROM descuentos WHERE descripcion = '{$pValores['descripcion']}';";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo eliminar " . $th->getMessage);
            }
        }

        public function consultarDescuentos($pValores){
            try {
                $sql = "SELECT *, COUNT(*) AS contador FROM descuentos WHERE descripcion = '{$pValores['descripcion']}';";
                return parent::Consultar($sql);;
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consultar " . $th->getMessage);
            }
        }

        public function consultaLista(){
            try {
                $sql = "SELECT * FROM descuentos;";
                return parent::Consultar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consultar lista " . $th->getMessage);
            }
        }
    }
    /*$valores = array("descripcion" => "",
    "descuento" => "50.00",
    "btnManDescuento" => 2);*/
    //$datDescruentos = new datDescuentos();
    //$datDescruentos->insertar($valores);
    //$datDescruentos->modificar($valores);
    //$datDescruentos->eliminar($valores);
    //print_r($datDescruentos->consultarDescuentos($valores));
    //print_r($datDescruentos->consultaLista());

?>