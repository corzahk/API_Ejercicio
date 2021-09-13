<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";

    class tickets extends conexion {
            private $table = "tickets";
            private $usuarioid = "";
            private $ticketid = "";
            private $fecha = "";
            private $horainicio = "";
            private $horafin ="";
            private $estado = "";
            private $motivo = "";
            


            public function listaTickets($pagina = 1){
                $inicio  = 0 ;
                $cantidad = 100;
                if($pagina > 1){
                    $inicio = ($cantidad * ($pagina - 1)) +1 ;
                    $cantidad = $cantidad * $pagina;
                }
                $query = "SELECT TicketId,UsuarioId,Fecha,HoraInicio,HoraFin,Estado,Motivo FROM " . $this->table . " limit $inicio,$cantidad";
                $datos = parent::obtenerDatos($query);
                return ($datos);
            }

            public function obtenerTicket($id){
                $query = "SELECT * FROM ". $this->table . " WHERE TicketId = '$id'"; 
                return parent::obtenerDatos($query);
            }

            public function post ($json){
                $_respuestas = new respuestas;
                $datos =json_decode($json,true);

                if(!isset($datos['$token'])){
                        //
                        return $_respuestas->error_401();
                }else{
                    $this->token = $datos["token"];
                    $arrayToken = $this-> buscarToken();
                    if($arrayToken){

                        if(!isset($datos['nombre']) || !isset($datos['dni']) || !isset($datos['correo'])){
                    return $_respuestas-> error_400();
                }else{
                    $this->nombre = $datos['nombre'];
                    $this->dni = $datos['dni'];
                    $this->correo = $datos['correo'];
                    if(isset($datos['telefono'])) { $this->telefono = $datos['telefono']; }
                    if(isset($datos['direccion'])) { $this->direccion = $datos['direccion']; }
                    if(isset($datos['codigoPostal'])) { $this->codigoPostal = $datos['codigoPostal']; }
                    if(isset($datos['genero'])) { $this->genero = $datos['genero']; }
                    if(isset($datos['fechaNacimiento'])) { $this->fechaNacimiento = $datos['fechaNacimiento']; }
                    $resp = $this->insertarUsuario();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array("usuarioId" => $resp);
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }

                }

                    }else{
                        return $_respuestas->error_401("El token que envio es invalido");
                    }
                }

                
            }
            private function insertarUsuario(){
                $query = "INSERT INTO " . $this->table . " (DNI,Nombre,Direccion,CodigoPostal,Telefono,Genero,FechaNacimiento,Correo)
                values
                ('" . $this->dni . "','" . $this->nombre . "','" . $this->direccion ."','" . $this->codigoPostal . "','"  . $this->telefono . "','" . $this->genero . "','" . $this->fechaNacimiento . "','" . $this->correo . "')"; 
                print_r($query);
                $resp = parent::nonQueryId($query);
                if($resp){
                     return $resp;
                }else{
                    return 0;
                }
            }

            public function put ($json){
                $_respuestas = new respuestas;
                $datos =json_decode($json,true);

                if(!isset($datos['$token'])){
                    //
                    return $_respuestas->error_401();
            }else{
                $this->token = $datos["token"];
                $arrayToken = $this-> buscarToken();
                if($arrayToken){
                    if(!isset($datos['usuarioId'])){
                        return $_respuestas-> error_400();
                    }else{
                        $this->usuarioid = $datos['usuarioId'];
                        if(isset($datos['nombre'])) { $this->nombre = $datos['nombre']; }
                        if(isset($datos['dni'])) { $this->dni = $datos['dni']; }
                        if(isset($datos['correo'])) { $this->correo = $datos['correo']; }
                        
                        if(isset($datos['telefono'])) { $this->telefono = $datos['telefono']; }
                        if(isset($datos['direccion'])) { $this->direccion = $datos['direccion']; }
                        if(isset($datos['codigoPostal'])) { $this->codigoPostal = $datos['codigoPostal']; }
                        if(isset($datos['genero'])) { $this->genero = $datos['genero']; }
                        if(isset($datos['fechaNacimiento'])) { $this->fechaNacimiento = $datos['fechaNacimiento']; }
                        $resp = $this->modificarUsuario();
                        if($resp){
                            $respuesta = $_respuestas->response;
                            $respuesta["result"] = array("usuarioId" => $this->usuarioid);
                            return $respuesta;
                        }else{
                            return $_respuestas->error_500();
                        }
    
                    }
                }else{
                    return $_respuestas->error_401("El token que envio es invalido");
                }
            }

                
            }

            private function modificarUsuario(){
                $query = "UPDATE " . $this->table . " SET Nombre ='" . $this->nombre . "',Direccion = '" . $this->direccion . "', DNI = '" . $this->dni . "', CodigoPostal = '" .
                $this->codigoPostal . "', Telefono = '" . $this->telefono . "', Genero = '" . $this->genero . "', FechaNacimiento = '" . $this->fechaNacimiento . "', Correo = '" . $this->correo .
                 "' WHERE UsuarioId = '" . $this->usuarioid . "'"; 
                $resp = parent::nonQuery($query);
                if($resp >= 1){
                     return $resp;
                }else{
                    return 0;
                }
            }

            public function delete ($json){
                $_respuestas = new respuestas;
                $datos =json_decode($json,true);


                if(!isset($datos['$token'])){
                    //
                    return $_respuestas->error_401();
            }else{
                $this->token = $datos["token"];
                $arrayToken = $this-> buscarToken();
                if($arrayToken){
                    if(!isset($datos['usuarioId'])){
                        return $_respuestas-> error_400();
                    }else{
                        $this->usuarioid = $datos['usuarioId'];
                      
                        $resp = $this->eliminarUsuario();
                        if($resp){
                            $respuesta = $_respuestas->response;
                            $respuesta["result"] = array("usuarioId" => $this->usuarioid);
                            return $respuesta;
                        }else{
                            return $_respuestas->error_500();
                        }
    
                    }
                }else{
                    return $_respuestas->error_401("El token que envio es invalido");
                }
            }
               
            }
            private function eliminarUsuario(){
                $query = "DELETE FROM " . $this->table . " WHERE UsuarioId= '" . $this->usuarioid . "'";
                $resp = parent::nonQuery($query);
                if($resp >= 1 ){
                    return $resp;
                }else{
                    return 0;
                }
            }
            private function buscarToken(){
                $query = "SELECT  TokenId,AdministradorId,Estado from administradores_token WHERE Token = '" . $this->token . "' AND Estado = 'Activo'";
                $resp = parent::obtenerDatos($query);
                if($resp){
                    return $resp;
                }else{
                    return 0;
                }
            }

            private function actualizarToken($tokenid){
                $date = date("Y-m-d H:i");
                $query = "UPDATE administradores_token SET Fecha = '$date' WHERE TokenId = '$tokenid' ";
                $resp = parent::nonQuery($query);
                if($resp >= 1){
                    return $resp;
                }else{
                    return 0;
                }
            }
        
    }

?>