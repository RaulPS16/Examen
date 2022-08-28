<?php

    include_once("datDescuentos.php");

    class prcManDescuento extends datDescuentos{
        
        public function __construct($pValoresPantalla = NULL){
            parent::__construct();
            switch ($pValoresPantalla['btnManDescuento']) {
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
                    header("Location: manDescuento.php?error=1");
                    break;
            }
        }

        private function funConsultar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["descripcion"])) {
                    header("Location: manDescuento.php?error=2");
                    exit;
                }

                $datosConsulta = parent::consultarDescuentos($pValoresPantalla);

                if ($datosConsulta[0]["contador"] == 0) {
                    header("Location: manDescuento.php?error=4");
                    exit;
                }

                $datosConsulta = serialize($datosConsulta);
                $datosConsulta = urlencode($datosConsulta);
                header("Location: manDescuento.php?datosConsulta={$datosConsulta}");
            } catch (Exeption $th) {
                header("Location: manDescuento.php?error=3");
            }
        }

        private function funInsertar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["descripcion"]) ||
                    !isset($pValoresPantalla["descuento"])) {
                    header("Location: manDescuento.php?error=2");
                    exit;
                }
                
                $datosInsertar = parent::insertar($pValoresPantalla);
                header("Location: manDescuento?error=0");
    
            } catch (Exeption $th) {
                header("Location: manDescuento.php?error=3");
            }
        }

        private function funModificar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["descripcion"]) ||
                    !isset($pValoresPantalla["descuento"])) {
                    header("Location: manDescuento.php?error=2");
                    exit;
                }
                if (isset($pValoresPantalla["indi_admin"])) {
                    $pValoresPantalla["indi_admin"] = 1;
                }else {
                    $pValoresPantalla["indi_admin"] = 0;
                }
                
                $datosModificar = parent::modificar($pValoresPantalla);
                header("Location: manDescuento?error=0");
    
            } catch (Exeption $th) {
                header("Location: manDescuento.php?error=3");
            }
        }

        private function funEliminar($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["descripcion"])) {
                    header("Location: manDescuento.php?error=2");
                    exit;
                }
                
                $datosEliminar = parent::eliminar($pValoresPantalla);
                header("Location: manDescuento?error=0");
    
            } catch (Exeption $th) {
                header("Location: manDescuento.php?error=3");
            }
        }
    }

    
    
    $valoresPantalla = array("descripcion" => $_POST['descripcion'],
    "descuento" => $_POST['descuento'],
    "btnManDescuento" => $_POST['btnManDescuento']);
    $prcManDescuento = new prcManDescuento($valoresPantalla);


?>