<?php

    $data = json_decode(file_get_contents('php://input'), true);

    if( isset($data['nombre']) && !empty($data['nombre']) ){
        if (isset($data['correo']) && !empty($data['correo'])){
            if(isset($data['asunto']) && !empty($data['asunto'])){
                if (isset($data['mensaje']) && !empty($data['mensaje'])){
                    $nombre = $data['nombre'];
                    $correo = 'academia.estudioxv@gmail.com';
                    $asunto = $data['asunto'];
                    $mensaje = $data['mensaje'];
                    $cabeceras = 'From: '.$data['correo'] . "\r\n" .
                        'Reply-To: ing.fragoso94@gmail.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    mail($correo, $asunto, $mensaje, $cabeceras);
                }else{ echo parsinJson(false, "El mensaje es requerido"); }
            }else{
                echo parsinJson(false, "El asunto es requerido");
            }
        }else{
            echo parsinJson(false, "El correo es requerido");
        }
    }else{
        echo parsinJson(false, "El nombre es requerido");
    }

    function parsinJson($status, $mensaje){
        return json_encode(['estatus'=>$status, 'mensaje'=>$mensaje]);
    }