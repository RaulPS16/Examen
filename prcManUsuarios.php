<?php

    include_once("datUsuarios.php");

    class prcManUsuarios extends datUsuarios{
        
        public function __construct($pValoresPantalla = NULL){
            parent::__construct();
            switch ($pValoresPantalla['btnManUsuarios']) {
                case 'Consultar':
                        $this->funConsultar($pValoresPantalla);
                    break;
                case 'Insertar':
                        $this->funInsertar($pValoresPantalla);
                    break;
                case 'Modificar':
                        $this->funModificar($pValoresPantalla);
                    break;
                case 'Eliminar':
                        $this->funEliminar($pValoresPantalla);
                    break;
                default:
                    header("Location: manUsuarios.php?error=1");
                    break;
            }
        }

        private function funConsultar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["id_usuario"])) {
                    header("Location: manUsuarios.php?error=2");
                    exit;
                }
                if (isset($pValoresPantalla["indi_admin"])) {
                    $pValoresPantalla["indi_admin"] = 1;
                }else {
                    $pValoresPantalla["indi_admin"] = 0;
                }

                $datosConsulta = parent::consultaManUsuario($pValoresPantalla);

                if ($datosConsulta[0]["contador"] == 0) {
                    header("Location: manUsuarios.php?error=4");
                    exit;
                }

                $datosConsulta = serialize($datosConsulta);
                $datosConsulta = urlencode($datosConsulta);
                header("Location: manUsuarios?datosConsulta={$datosConsulta}");
            } catch (Exeption $th) {
                header("Location: manUsuarios.php?error=3");
            }
        }

        private function funInsertar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["id_usuario"]) ||
                    !isset($pValoresPantalla["clave"])) {
                    header("Location: manUsuarios.php?error=2");
                    exit;
                }
                if (isset($pValoresPantalla["indi_admin"])) {
                    $pValoresPantalla["indi_admin"] = 1;
                }else {
                    $pValoresPantalla["indi_admin"] = 0;
                }
                
                $datosInsertar = parent::insertar($pValoresPantalla);
                header("Location: manUsuarios?error=0");
    
            } catch (Exeption $th) {
                header("Location: manUsuarios.php?error=3");
            }
        }

        private function funModificar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["id_usuario"]) ||
                    !isset($pValoresPantalla["clave"])) {
                    header("Location: manUsuarios.php?error=2");
                    exit;
                }
                if (isset($pValoresPantalla["indi_admin"])) {
                    $pValoresPantalla["indi_admin"] = 1;
                }else {
                    $pValoresPantalla["indi_admin"] = 0;
                }
                
                $datosModificar = parent::modificar($pValoresPantalla);
                header("Location: manUsuarios?error=0");
    
            } catch (Exeption $th) {
                header("Location: manUsuarios.php?error=3");
            }
        }

        private function funEliminar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["id_usuario"])) {
                    header("Location: manUsuarios.php?error=2");
                    exit;
                }
                
                $datosEliminar = parent::eliminar($pValoresPantalla);
                header("Location: manUsuarios?error=0");
    
            } catch (Exeption $th) {
                header("Location: manUsuarios.php?error=3");
            }
        }
    }

    
    
    $valoresPantalla = array("id_usuario" => $_POST['id_usuario'],
    "clave" => $_POST['clave'],
    //"ini_admin" => $_POST['ini_admin'],
    "btnManUsuarios" => $_POST['btnManUsuarios']);
    if (isset($_POST['ini_admin'])) {
        $valoresPantalla["ini_admin"] = $_POST['ini_admin'];
    }
    $prcManUsuarios = new prcManUsuarios($valoresPantalla);


?>