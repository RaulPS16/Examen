<?php
    include_once("datTipoTarifa.php");

    class selectTarifas extends datTipoTarifa{
        
        private $primerTarifa = '';

        public function __construct($pTarifa = ''){
            parent::__construct();

            $this->primerTarifa = $pTarifa;

            $this->muestaSelect();
            
        }

        public function muestaSelect(){
            try {
                $lista = parent::consultaLista($this->primerTarifa);
                echo '<select class="form-select" name="tarifa" id="monto_tarifa" aria-describedby="basic-addon">';
                if ($this->primerTarifa == '') {
                    echo '<option value="">Seleccione una tarifa</option>';
                }
                foreach ($lista as $key => $value) {
                    echo '<option value="' . $value["descripcion"] . '">' . $value["descripcion"] . '</option>';
                }
                echo '</select>';
            } catch (\Throwable $th) {
                echo '<select class="form-select" name="monto_tarifa" id="monto_tarifa" aria-describedby="basic-addon">
                        <option value="error">No se han cargado los datos</option>
                    </select>';
            }
        }

    }

    include_once("datDescuentos.php");

    class selectDescuentos extends datDescuentos{
        
        private $primerDescuento = '';

        public function __construct($pDescuento = ''){
            parent::__construct();

            $this->primerDescuento = $pDescuento;

            $this->muestaSelect();
        }

        public function muestaSelect(){
            try {
                $lista = parent::consultaLista($this->primerDescuento);
                echo '<select class="form-select" name="descuento" id="monto_descuento" aria-describedby="basic-addon2">';
                if ($this->primerDescuento == '') {
                    echo '<option value="">Seleccione un descuento</option>';
                }
                foreach ($lista as $key => $value) {
                    echo '<option value="' . $value["descripcion"] . '">' . $value["descripcion"] . '</option>';
                }
                echo '</select>';
            } catch (\Throwable $th) {
                echo '<select class="form-select" name="monto_descuento" id="monto_descuento" aria-describedby="basic-addon">
                        <option value="error">No se han cargado los datos</option>
                    </select>';
            }
        }
    }

?>