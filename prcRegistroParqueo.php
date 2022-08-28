<?php

    include_once("datRegistroParqueo.php");

    class prcRegistroParqueo extends datRegistroParqueo{
        
        public function __construct($pValoresPantalla = NULL){
            parent::__construct();
            switch ($pValoresPantalla['btnRegistroParqueo']) {
                case 'Ingreso':
                        $this->funIngreso($pValoresPantalla);
                    break;
                case 'Calcular monto':
                        $this->funCalcular($pValoresPantalla);
                    break;
                case 'Salida':
                        $this->funSalida($pValoresPantalla);
                    break;
                default:
                    header("Location: registroParqueo.php?error=1");
                    break;
            }
        }

        private function funIngreso($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["placa"])) {
                    header("Location: registroParqueo.php?error=4");
                    exit;
                }
                $pValoresPantalla["usuario_entrada"] = "604320137";
                $pValoresPantalla["fecha_entrada"] = date("Y-m-d");
                $pValoresPantalla["hora_entrada"] = date("H:i:s");

                parent::insertar($pValoresPantalla);
                header("Location: registroParqueo.php?error=0");

            } catch (Exeption $th) {
                header("Location: registroParqueo.php?error=3");
            }
        }

        private function funCalcular($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["placa"]) ||
                    !isset($pValoresPantalla["tarifa"]) ||
                    !isset($pValoresPantalla["descuento"])) {
                    header("Location: registroParqueo.php?error=2");
                    exit;
                }
                //$datosConsulta = serialize($datosConsulta);
                //$datosConsulta = urlencode($datosConsulta);
    
            } catch (Exeption $th) {
                header("Location: registroParqueo.php?error=3");
            }
        }

        private function funSalida($pValoresPantalla){
            try {
                if (!isset($pValoresPantalla["placa"]) ||
                    !isset($pValoresPantalla["tarifa"])) {
                    header("Location: registroParqueo.php?error=2");
                    exit;
                }
                $pValoresPantalla["usuario_salida"] = "604320137";
                $pValoresPantalla["fecha_salida"] = date("Y-m-d");
                $pValoresPantalla["hora_salida"] = date("H:i:s");

                $conusltaXPlaca = parent::consultaPlaca($pValoresPantalla["placa"]);
                if ($conusltaXPlaca[0]['contador'] == 0) {
                    header("Location: registroParqueo.php?error=4");
                    exit;
                }
                //Convierte los datos de horas en DateTime para calcular la diferencia
                $horaEntrada = new DateTime($conusltaXPlaca[0]["hora_entrada"]);
                $hora_salida = new DateTime($pValoresPantalla["hora_salida"]);

                $difHoras = $hora_salida->diff($horaEntrada);

                //Optiene los montos de la tarifa y descuentos
                $descuentoTarifa =parent::consultaDescuentoTarifa($pValoresPantalla);
                if ($descuentoTarifa[0]["contador"] == 0) {
                    header("Location: registroParqueo.php?error=3");
                    exit;
                }

                //calcula los minutos pasados
                $minutos = (($difHoras->d * 60)*60) + ($difHoras->h * 60) + $difHoras->i;
                // Calcula el monto menos el porsentaje de descuento
                $totalPagar = ($minutos * floatval($descuentoTarifa[0]["monto_tarifa"])) - (($minutos * floatval($descuentoTarifa[0]["monto_tarifa"])) * (floatval($descuentoTarifa[0]["monto_descuento"]) / 100) );

                //Agrega variables a $pValoresPantalla para modificar el registro
                $pValoresPantalla["horas_parqueo"] = $difHoras->h . ':' . $difHoras->i . ':' . $difHoras->s;
                $pValoresPantalla["monto_tarifa"] = $descuentoTarifa[0]["monto_tarifa"];
                $pValoresPantalla["monto_descuento"] = $descuentoTarifa[0]["monto_descuento"];
                $pValoresPantalla["monto_pagar"] = $totalPagar;

                parent::modificarSalida($pValoresPantalla);

                $pValoresPantalla = serialize($pValoresPantalla);
                $pValoresPantalla = urlencode($pValoresPantalla);
                header("Location: registroParqueo.php?error=0&datosConsulta={$pValoresPantalla}");
    
            } catch (Exeption $th) {
                header("Location: manUsuarios.php?error=3");
            }
        }

    }

    
    
    $datosPantalla = array("placa" => $_POST['placa'],
    "btnRegistroParqueo" => $_POST['btnRegistroParqueo']);

    if (isset($_POST['tarifa']) && $_POST['tarifa'] <> '') {
        $datosPantalla['tarifa'] = $_POST['tarifa'];
    }
    if ($_POST['descuento'] <> '') {
        $datosPantalla['descuento'] = $_POST['descuento'];
    }else{
        $datosPantalla['descuento'] = "Sin descuento";
    }
    $prcRegistroParqueo = new prcRegistroParqueo($datosPantalla);


?>