<?php
    require_once 'conexion/conexion.php';
    require_once 'respuestas.class.php';


        class auth extends conexion{
            public function login($json){
                $_respuestas = new respuestas;
                $datos = json_decode($json, true);
                if(!isset($datos['usuario']) || !isset($datos["password"]))
                {
                    return $_respuestas->error_400();
            }else{
                $usuario = $datos['usuario'];
                $password = $datos['password'];
                $password = parent::encriptar($password);
                $datos = $this->obtenerDatosUsuario($usuario);
                if($datos){
                    //varificar si la contraseña es igual
                    if($password == $datos[0]['Password']){
                        if($datos[0]['Estado'] == "Activo"){
                            $verificar = $this->insertarToken($datos[0]['AdministradorId']);
                            if($verificar){
                                    //si se guardo

                                    $result = $_respuestas->response;
                                    $result ["result"] = array ( "token" => $verificar);
                                    return $result;

                            }else{
                                //error al guardar
                                return $_respuestas->error_500("Error interno, no hemos podido guardar");

                            }
                        }else{
                                //usuario no esta activo
                                return $_respuestas->error_200("El usuario $usuario no esta activo");
                        }

                    }else{
                        //la contraseña no es igual
                        return $_respuestas->error_200("Password es invalido");
                    }
                }else{
                    //no existe el usuario
                    return $_respuestas->error_200("El usuario $usuario no existe");
                }
            }


        }
    
        private function obtenerDatosUsuario($correo){
            $query = "SELECT AdministradorId, Password, Estado FROM administradores WHERE Usuario = '$correo'";
            $datos = parent::obtenerDatos($query);

            if(isset($datos[0]["AdministradorId"])){
                return $datos;
            }else{
                return 0;
            }
        }

        private function insertarToken($administradorid){
            $val = true;
            $token =bin2hex(openssl_random_pseudo_bytes(16, $val));
            $date = date("Y-m-d H:i");
            $estado = "Activo";
            $query = "INSERT INTO administradores_token (AdministradorId, Token, Estado, Fecha)VALUES('$administradorid', '$token', '$estado', '$date')";
            $verifica = parent::nonQuery($query);
                if($verifica){
                    return $token;
                }else{
                    return 0;
                }

        }
    }

?>
