<?php

    include_once("datTipoTarifa.php");

    class prcManTipoTarifa extends datTipoTarifa{
        
        public function __construct($pValoresPantalla = NULL){
            parent::__construct();
            switch ($pValoresPantalla['btnManTipoTarifa']) {
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
                    header("Location: manTipoTarifa.php?error=1");
                    break;
            }
        }

        private function funConsultar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["descripcion"]) ||
                    !isset($pValoresPantalla["monto_tarifa"])) {
                    header("Location: manTipoTarifa.php?error=2");
                    exit;
                }

                $datosConsulta = parent::consultarTipoTarifa($pValoresPantalla);

                if ($datosConsulta[0]["contador"] == 0) {
                    header("Location: manTipoTarifa.php?error=4");
                    exit;
                }

                $datosConsulta = serialize($datosConsulta);
                $datosConsulta = urlencode($datosConsulta);
                header("Location: manTipoTarifa.php?datosConsulta={$datosConsulta}");
            } catch (Exeption $th) {
                header("Location: manTipoTarifa.php?error=3");
            }
        }

        private function funInsertar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["descripcion"]) ||
                    !isset($pValoresPantalla["monto_tarifa"])) {
                    header("Location: manTipoTarifa.php?error=2");
                    exit;
                }
                
                $datosInsertar = parent::insertar($pValoresPantalla);
                header("Location: manTipoTarifa?error=0");
    
            } catch (Exeption $th) {
                header("Location: manTipoTarifa.php?error=3");
            }
        }

        private function funModificar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["descripcion"]) ||
                    !isset($pValoresPantalla["monto_tarifa"])) {
                    header("Location: manTipoTarifa.php?error=2");
                    exit;
                }
                $datosModificar = parent::modificar($pValoresPantalla);
                header("Location: manTipoTarifa?error=0");
    
            } catch (Exeption $th) {
                header("Location: manTipoTarifa.php?error=3");
            }
        }

        private function funEliminar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["descripcion"])) {
                    header("Location: manTipoTarifa.php?error=2");
                    exit;
                }
                
                $datosEliminar = parent::eliminar($pValoresPantalla);
                header("Location: manTipoTarifa?error=0");
    
            } catch (Exeption $th) {
                header("Location: manTipoTarifa.php?error=3");
            }
        }
    }

    
    
    $valoresPantalla = array("descripcion" => $_POST['descripcion'],
    "monto_tarifa" => $_POST['monto_tarifa'],
    "btnManTipoTarifa" => $_POST['btnManTipoTarifa']);
    $prcmanTipoTarifa = new prcmanTipoTarifa($valoresPantalla);


?>