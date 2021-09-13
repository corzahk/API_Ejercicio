<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/usuarios.class.php';
$_respuestas = new respuestas;

$_usuarios = new usuarios;


    if($_SERVER ['REQUEST_METHOD'] == "GET"){
        if(isset($_GET["page"])){
            $pagina = $_GET["page"];
           $listaUsuarios = $_usuarios->listaUsuarios($pagina);
            echo json_encode($listaUsuarios);
        }else if (isset($_GET['id'])){
            $usuarioid = $_GET['id'];
            $datosUsario = $_usuarios->obtenerUsario($usuarioid);
            echo json_encode($datosUsario);
        }
       
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
        echo "hola post";
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