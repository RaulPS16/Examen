<?php
    include_once("ConexionDB.php");

    class datRegistroParqueo extends ConexionDB{
        
        public function __construct(){
            parent::__construct();
        }

        public function insertar($pValores){
            try {
                $sql = "INSERT INTO registro_parqueo (id, placa, usuario_entrada, fecha_entrada, hora_entrada) VALUES (0,'{$pValores['placa']}', '{$pValores['usuario_entrada']}', '{$pValores['fecha_entrada']}', '{$pValores['hora_entrada']}');";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo insertar " . $th->getMessage);
            }
            
        }

        public function modificarSalida($pValores){
            try {
                $sql = "UPDATE registro_parqueo SET usuario_salida = '{$pValores['usuario_salida']}', fecha_salida = '{$pValores['fecha_salida']}', hora_salida = '{$pValores['hora_salida']}', horas_parqueo = '{$pValores['horas_parqueo']}', monto_tarifa = {$pValores['monto_tarifa']}, descuento = {$pValores['monto_descuento']}, monto_pagar = {$pValores['monto_pagar']} WHERE placa = '{$pValores['placa']}';";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo modificar " . $th->getMessage);
            }
        }

        public function eliminar($pValores){
            try {
                $sql = "DELETE FROM registro_parqueo WHERE placa = '{$pValores['placa']}';";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo eliminar " . $th->getMessage);
            }
        }

        public function consultaLista($pFecha = '', $pPlaca = ''){
            try {
                $sql = "SELECT * FROM registro_parqueo WHERE 1=1 ";
                
                if ($pFecha <> '') {
                    $sql .= " AND fecha_entrada = '{$pFecha}'";
                }
                if ($pPlaca <> '') {
                    $sql .= " AND placa = '{$pPlaca}'";
                }
                
                $sql .= " ORDER BY fecha_entrada, hora_entrada DESC;";
                return parent::Consultar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consultar lista " . $th->getMessage);
            }
        }

        public function consultaContador(){
            try {
                $sql = "SELECT COUNT(*) AS total FROM registro_parqueo;";
                return parent::Consultar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consultar lista " . $th->getMessage);
            }
        }

        public function consultaPlaca($pPlaca){
            try {
                $sql = "SELECT *, count(*) AS contador FROM registro_parqueo WHERE placa = '{$pPlaca}';";
                return parent::Consultar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consultar placa " . $th->getMessage);
            }
        }

        public function consultaDescuentoTarifa($pValores){
            try {
                $sql = "SELECT descuentos.descripcion AS 'descripcion_descuento', 
                descuentos.descuento AS 'monto_descuento', 
                tipo_tarifa.descripcion AS 'descripcion_tarifa', 
                tipo_tarifa.monto_tarifa AS 'monto_tarifa', 
                COUNT(*) AS contador 
                FROM `descuentos` INNER JOIN tipo_tarifa 
                ON 1=1 
                WHERE descuentos.descripcion = '{$pValores["descuento"]}' 
                AND tipo_tarifa.descripcion = '{$pValores["tarifa"]}';";
                return parent::Consultar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consultaDescuentoTarifa " . $th->getMessage);
            }
        }

    }
    /*$valores = array("placa" => "BCC321",
    "usuario_entrada" => "Rodrigo",
    "fecha_entrada" => "2022-08-27",
    "hora_entrada" => "17:30:00",
    "id" => 2,
    "usuario_salida" => "Raul",
    "fecha_salida" => "2022-08-27",
    "hora_salida" => "19:00:00",
    "horas_parqueo" => "2:30:00",
    "monto_tarifa" => "1000.00",
    "descuento" => "50.00",
    "monto_pagar" => "1250.00");*/
    //$datRegistroParqueo = new datRegistroParqueo();
    //$datRegistroParqueo->insertar($valores);
    //$datRegistroParqueo->modificar($valores);
    //$datRegistroParqueo->eliminar($valores);
    //print_r($datRegistroParqueo->consultarRegistroParqueo($valores));
    //print_r($datRegistroParqueo->consultaLista(0, 5, $valores));
/**
 * INSERT INTO `registro_parqueo` (`id`, `placa`, `usuario_entrada`, `fecha_entrada`, `hora_entrada`, `usuario_salida`, `fecha_salida`, `hora_salida`, `horas_parqueo`, `monto_tarifa`, `descuento`, `monto_pagar`) VALUES (NULL, 'BCC123', 'Raul', '2022-08-27', '17:00:00', 'Raul', '2022-08-27', '18:00:00', '01:00:00', '1000.00', '0.00', '1000.00');
 */
?>