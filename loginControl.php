<?php
    include_once("datUsuarios.php");

    class loginControl extends datUsuarios{

        private $datUsuarios = NULL;

        //Clase __construct que resive tiempo de espera, usuario y clave
        function __construct($pTiempo=60, $pUsuario=Null, $pClave=Null){
            if ($pUsuario==Null && $pClave==Null) {
                // si $_SESSION['sUsiario'] contiene algo entonces está logeado
                if (!isset($_SESSION['sId_Usuario'])) {
                    //si $_COOKIE['cUsuario'] contiene algo entonces el login aun es vigente
                    if (isset($_COOKIE['cUsuario'])) {
                        //inicializa $_SESSION['sUsuaria']
                        $_SESSION['sId_Usuario'] = $_COOKIE['cUsuario'];
                    }else{
                        //Devuelve error 16
                        header("Location: index.php?error=16");
                    }
                }
                // Valida $_SESSION['tiempoLogin'] tiene algo y valida que el timepo no sea mayot a los segundos de $pTiempo
                if (isset($_SESSION['sTiempoLogin']) &&
                (time() > $_SESSION['sTiempoLogin'] ) ) {
                    session_unset();
                    session_destroy();
                    header("Location: index.php?error=18");
                }
            }else{
                //si el usuario y clave es <> NULL llama al metodo verificaUsuario
                parent::__construct();
                $this->verificaUsuario($pTiempo,$pUsuario,$pClave);
            }
        } // fin __construct

        private function verificaUsuario($pTiempo,$pUsuario,$pClave){
            $valores = array("id_usuario" => $pUsuario,
                            "clave" => $pClave);
            $resultLogin = parent::consultaUsuario($valores);
            //$resultLogin = $this->datUsuarios->consultar($valores);
            if ($resultLogin[0]['contador'] <> 0) {
                //encripta con hash MD5
                $idUsuario = $pUsuario;
                // Se crea la cookie cUsuario, se le pasa el tiempo + lo deficido en $pTiempo
                setcookie("cUsuario",$idUsuario,time()+$pTiempo);
                // Guarda el tiempo de login
                $_SESSION['sTiempoLogin'] = time() + $pTiempo;
                // instancia el rol, id_usuario y modifica fecha de ultimo ingreso en las variables sesiones
                if ($resultLogin[0]['indi_admin'] == 1) {
                    $_SESSION['sAdmin'] = "Admin";
                }else {
                    $_SESSION['sAdmin'] = "";
                }
                $_SESSION['sId_Usuario'] = $resultLogin[0]['id_usuario'];
                // ingresa al inicio del sitio
                
                header("Location: registroParqueo.php");

            }else{
                // si la clave no es correcta entonces genera un error
                header("Location: index.php?error=17");
            }
        }//fin verificaUsuario

    }
    if (isset($_POST['id_usuario']) || isset($_POST['clave'])) {
        $logrinControl = new loginControl(3600,$_POST['id_usuario'],$_POST['clave']);
    }
    //$logrinControl = new loginControl(3600,"Raul","12345");
?>