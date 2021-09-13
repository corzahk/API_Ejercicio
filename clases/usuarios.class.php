<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";

    class usuarios extends conexion {
            private $table = "usuarios";
            public function listaUsuarios($pagina = 1){
                $inicio  = 0 ;
                $cantidad = 100;
                if($pagina > 1){
                    $inicio = ($cantidad * ($pagina - 1)) +1 ;
                    $cantidad = $cantidad * $pagina;
                }
                $query = "SELECT UsuarioId,Nombre,DNI,Telefono,Correo FROM " . $this->table . " limit $inicio,$cantidad";
                $datos = parent::obtenerDatos($query);
                return ($datos);
            }

            public function obtenerUsario($id){
                $query = "SELECT * FROM ". $this->table . " WHERE UsuarioId = '$id'"; 
                return parent::obtenerDatos($query);
            }

    }

?>