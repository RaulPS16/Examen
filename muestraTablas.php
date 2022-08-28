<?php

    include_once("datRegistroParqueo.php");

    class muestraTablas extends datRegistroParqueo{

        private $fecha = '';
        private $placa = '';
        private $montoTotal = 0;

        public function __construct($pfecha = '', $pPlaca = ''){
            parent::__construct();
            $this->fecha = $pfecha;
            $this->placa = $pPlaca;
            $this->generaTabla();
        }

        private function generaTabla(){
            try {
                $lista = parent::consultaLista($this->fecha, $this->placa);
                echo '<table class="table table-striped">
                <thead>
                    <th>Placa</th>
                    <th>Fecha y hora de entrada</th>
                    <th>Usuario Entrada</th>
                    <th>Fecha y hora de salida</th>
                    <th>Usuario salida</th>
                    <th>Horas de parqueo</th>
                    <th>Monto Tarifa</th>
                    <th>Descuento</th>
                    <th>Monto a pagar</th>
                </thead>';
                echo '<tbody>';
                foreach ($lista as $key => $value) {
                    echo '<tr>';
                    print_r('<th>' . $value["placa"] . '</th>');
                    print_r('<th>' . $value["fecha_entrada"] . ' ' . $value["hora_entrada"] . '</th>');
                    print_r('<th>' . $value["usuario_entrada"] . '</th>');
                    print_r('<th>' . $value["fecha_salida"] . ' ' . $value["hora_salida"] . '</th>');
                    print_r('<th>' . $value["usuario_salida"] . '</th>');
                    print_r('<th>' . $value["horas_parqueo"] . '</th>');
                    print_r('<th>' . $value["monto_tarifa"] . '</th>');
                    print_r('<th>' . $value["descuento"] . '</th>');
                    print_r('<th>' . $value["monto_pagar"] . '</th>');
                    echo '</tr>';
                    $this->montoTotal += floatval($value["monto_pagar"]);
                }
                echo '<tr>';
                echo '</tr>';
                echo '<td colspan="9" class="text-center"><h4>Monto total: ' . $this->montoTotal . '<h4></td>';
                echo '</tbody>';
                echo '</table>';

            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
    

?>