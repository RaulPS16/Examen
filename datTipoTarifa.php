<?php
    include_once("ConexionDB.php");

    class datTipoTarifa extends ConexionDB{
        
        public function __construct(){
            parent::__construct();
        }

        public function insertar($pValores){
            try {
                $sql = "INSERT INTO tipo_tarifa VALUES (NULL, '{$pValores['descripcion']}', {$pValores['monto_tarifa']});";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo insertar " . $th->getMessage);
            }
            
        }

        public function modificar($pValores){
            try {
                $sql = "UPDATE tipo_tarifa SET descripcion = '{$pValores['descripcion']}', monto_tarifa =  {$pValores['monto_tarifa']} WHERE descripcion = '{$pValores['descripcion']}';";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo modificar " . $th->getMessage);
            }
        }

        public function eliminar($pValores){
            try {
                $sql = "DELETE FROM tipo_tarifa WHERE descripcion = '{$pValores['descripcion']}';";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo eliminar " . $th->getMessage);
            }
        }

        public function consultarTipoTarifa($pValores){
            try {
                $sql = "SELECT *, COUNT(*) AS contador FROM tipo_tarifa WHERE descripcion = '{$pValores['descripcion']}';";
                return parent::Consultar($sql);;
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consultar " . $th->getMessage);
            }
        }

        public function consultaLista(){
            try {
                $sql = "SELECT * FROM tipo_tarifa;";
                return parent::Consultar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consultar lista " . $th->getMessage);
            }
        }
    }
    $valores = array("descripcion" => 'modifica tarifa',
    "monto_tarifa" => "1020495",
    "id" => 2);
    $datTipoTarifa = new datTipoTarifa();
    //$datTipoTarifa->insertar($valores);
    //$datTipoTarifa->modificar($valores);
    //$datTipoTarifa->eliminar($valores);
    //print_r($datTipoTarifa->consultarTipoTarifa($valores));
    //print_r($datTipoTarifa->consultaLista());

?>