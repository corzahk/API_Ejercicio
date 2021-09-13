<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/usuarios.class.php';
$_respuestas = new respuestas;

$_usuarios = new usuarios;


    if($_SERVER ['REQUEST_METHOD'] == "GET"){
        if(isset($_GET["page"])){
            $pagina = $_GET["page"];
           $listaUsuarios = $_usuarios->listaUsuarios($pagina);
           header("Content-Type: application/json");
            echo json_encode($listaUsuarios);
            http_response_code(200);
        }else if (isset($_GET['id'])){
            $usuarioid = $_GET['id'];
            $datosUsario = $_usuarios->obtenerUsario($usuarioid);
            header("Content-Type: application/json");
            echo json_encode($datosUsario);
            http_response_code(200);
        }
       
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos los datos al navegador
        $resp = $_usuarios->post($postBody);
        print_r($resp);
    }else if ($_SERVER['REQUEST_METHOD']== "PUT") {
        echo "hola put";
    }else if ($_SERVER['REQUEST_METHOD'] == "DELETE"){
        echo "hola delete";
    }else{
        header('Content-Type: application/json');
        $datosArray = $_respuestas->error_405();
        echo json_encode($datosArray);
    }   
         

?>