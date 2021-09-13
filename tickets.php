<?php 
    require_once 'clases/respuestas.class.php';
    require_once 'clases/tickets.class.php';

    $_respuestas = new respuestas;

    $_tickets = new tickets;


    if($_SERVER ['REQUEST_METHOD'] == "GET"){
        if(isset($_GET["page"])){
            $pagina = $_GET["page"];
           $listaTickets = $_tickets->listaTickets($pagina);
           header("Content-Type: application/json");
            echo json_encode($listaTickets);
            http_response_code(200);
        }else if (isset($_GET['id'])){
            $ticketid = $_GET['id'];
            $datosUsario = $_tickets->obtenerTicket($ticketid);
            header("Content-Type: application/json");
            echo json_encode($datosUsario);
            http_response_code(200);
        }
       
    }else if($_SERVER['REQUEST_METHOD'] == "POST"){
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos los datos al navegador
        $datosArray = $_usuarios->post($postBody);
        //devolvemos una respuesta
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);
    }else if ($_SERVER['REQUEST_METHOD']== "PUT") {
       //recibimos los datos enviados
       $postBody = file_get_contents("php://input");
       //enviamos datos al manejador
       $datosArray = $_usuarios->put($postBody);
       //devolvemos una respuesta
       header('Content-Type: application/json');
       if(isset($datosArray["result"]["error_id"])){
           $responseCode = $datosArray["result"]["error_id"];
           http_response_code($responseCode);
       }else{
           http_response_code(200);
       }
       echo json_encode($datosArray);



    }else if ($_SERVER['REQUEST_METHOD'] == "DELETE"){
        //recibimos los datos enviados
       $postBody = file_get_contents("php://input");
       //enviamos datos al manejador
       $datosArray = $_usuarios->delete($postBody);
       //devolvemos una respuesta
       header('Content-Type: application/json');
       if(isset($datosArray["result"]["error_id"])){
           $responseCode = $datosArray["result"]["error_id"];
           http_response_code($responseCode);
       }else{
           http_response_code(200);
       }
       echo json_encode($datosArray);
    }else{
        header('Content-Type: application/json');
        $datosArray = $_respuestas->error_405();
        echo json_encode($datosArray);
    }    
?>