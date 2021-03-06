<?php

class ControladorAdministrador
{

    public function login()
    {
        if (isset($_POST["email"]) && $_POST) {
            if (
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])
            ) {
                $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuario";
                $item  = "email";
                $valor = $_POST["email"];

                $respuesta = ModeloAdministrador::mostrarAdministrador($tabla, $item, $valor);

                if ($respuesta["email"] == $_POST["email"] && $respuesta["password"] == $encriptar) {
                    if ($respuesta["estado"] == 1) {

                        $_SESSION["validarSesion"] = "ok";
                        $_SESSION["id"]                   = $respuesta["id"];
                        $_SESSION["email"]                = $respuesta["email"];
                        $_SESSION["password"]             = $respuesta["password"];

                        echo '<script>

                            window.location = "inicio";

                        </script>';
                    } else {

                        echo '<br>
                        <div class="alert alert-warning">Este usuario aún no está activado</div>';
                    }
                } else {

                    echo '<br>
                    <div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>';
                    echo "<script>console.log( 'Debug Objects: " . "erro2" . "' );</script>";
                }
            }
        }
    }

    public static function mostrarAdministrador($item, $valor)
    {

        $tabla = "usuario";

        $respuesta = ModeloAdministrador::mostrarAdministrador($tabla, $item, $valor);

        return $respuesta;
    }

    public static function crearPerfil()
    {

        if (isset($_POST["email"])) {
            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])
            ) {
                $tabla = "usuario";

                $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array(
                    "email"                 => $_POST["email"],
                    "password"              => $encriptar,
                    "estado"                => 1
                );

                $respuesta = ModeloAdministrador::ingresarPerfil($tabla, $datos);

                if ($respuesta == "ok") {


                    echo '<script> window.location = "usuarios";</script>';
                }
            } else {

                echo '<script> window.location = "usuarios";</script>';
            }
        }
    }

    public static function editarPerfil()
    {

        if (isset($_POST["editarPassword"]) && $_POST["editarPassword"] != "") {
            $tabla = "usuario";

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
                echo "<script>console.log( 'Debug Objects: " . $_POST["iduser"] . "' );</script>";

                $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array(
                    "id" => $_POST["iduser"],
                    "email"             => $_POST["editarEmail"],
                    "password"          => $encriptar,
                );

                $respuesta = ModeloAdministrador::editarPerfil($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script> window.location = "usuarios";</script>';
                }
            }
        }
    }


    public static function eliminarPerfil($id)
    {
        $tabla = "usuario";
        $respuesta = ModeloAdministrador::eliminarPerfil($tabla, $id);

        if ($respuesta == "ok") {
            echo '<script> window.location = "usuarios";</script>';
        }
    }
    public static function updateEstado($id)
    {
        $data =explode("-",$id);
        $tabla = "usuario";
        $setColum = "estado";
        $setValor = $data[1]==0? 1:0;
        $whereColum = "id"; 
        $whereValor = $data[0];
        $respuesta = ModeloAdministrador::actualizarPerfil($tabla, $setColum, $setValor, $whereColum, $whereValor);

        if ($respuesta == "ok") {
            echo '<script> window.location = "usuarios";</script>';
        }
    }
}
