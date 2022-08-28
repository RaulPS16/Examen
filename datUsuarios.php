<?php
    include_once("ConexionDB.php");

    class datUsuarios extends ConexionDB{
        
        public function __construct(){
            parent::__construct();
        }

        public function insertar($pValores){
            try {
                $sql = "INSERT INTO usuarios VALUES (NULL, '{$pValores['id_usuario']}', '{$pValores['clave']}', {$pValores['indi_admin']});";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo insertar " . $th->getMessage);
            }
            
        }

        public function modificar($pValores){
            try {
                $sql = "UPDATE usuarios SET id_usuario = '{$pValores['id_usuario']}', clave =  '{$pValores['clave']}', indi_admin = {$pValores['indi_admin']} WHERE id_usuario = '{$pValores['id_usuario']}';";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo modificar " . $th->getMessage);
            }
        }

        public function eliminar($pValores){
            try {
                $sql = "DELETE FROM usuarios WHERE id_usuario = '{$pValores['id_usuario']}';";
                parent::ejecutar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo eliminar " . $th->getMessage);
            }
        }

        public function consultaUsuario($pValores){
            try {
                $sql = "SELECT *, count(*) AS contador FROM usuarios WHERE id_usuario = '{$pValores['id_usuario']}' AND clave = '{$pValores['clave']}';";
                return parent::Consultar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consultar " . $th->getMessage);
            }
        }

        public function consultaLista(){
            try {
                $sql = "SELECT * FROM usuarios;";
                return parent::Consultar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consulta Lista " . $th->getMessage);
            }
        }

        public function consultaManUsuario($pValores){
            try {
                $sql = "SELECT *, count(*) AS contador FROM usuarios WHERE id_usuario = '{$pValores['id_usuario']}'";
                return parent::Consultar($sql);
            } catch (Exeption $th) {
                throw new Exception("Error en metodo consulta Lista " . $th->getMessage);
            }
        }
    }
    /*$valores = array("id_usuario" => 'Juan',
    "clave" => "12345",
    "indi_admin" => "0",
    "id" => 3);*/
    //$datUsuario = new datUsuarios();
    //$datUsuario->insertar($valores);
    //$datUsuario->modificar($valores);
    //$datUsuario->eliminar($valores);
    //print_r($datUsuario->consultaUsuario($valores));
    //print_r($datUsuario->consultaLista());

?>