<?php

    $data = json_decode(file_get_contents('php://input'), true);

    if( isset($data['nombre']) && !empty($data['nombre']) ){
        if (isset($data['correo']) && !empty($data['correo'])){
            if(isset($data['asunto']) && !empty($data['asunto'])){
                if (isset($data['mensaje']) && !empty($data['mensaje'])){
                    $nombre = $data['nombre'];
                    $correo = $data['correo'];
                    $correoAdmin = 'ing.fragoso94@gmail.com';
                    $asunto = $data['asunto'];
                    $mensaje = $data['mensaje'];
                    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                    $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                    // Cabeceras adicionales
                    $cabeceras .= 'To: <betoliraxv@gmail.com>' . "\r\n";
                    $cabeceras .= 'From: '. $correo . "\r\n";
                    $cabeceras .= 'Cc: daniel.fragoso94@hotmail.com' . "\r\n";
                    $estructuraMensaje = '
                                         <html>
                                         <head>
                                           <title>Estudio Quince</title>
                                         </head>
                                         <body>
                                           <p>¡Notificación de la Página Web!</p>
                                           <table>
                                             <tr>
                                               <th>De:</th><td>'.$nombre.'</td>
                                             </tr>
                                             <tr>
                                               <th>Asunto:</th><td>'.$asunto.'</td>
                                             </tr>
                                            <tr>
                                                <th>Correo/Teléfono:</th><td>'.$correo.'</td>
                                            </tr>
                                            <tr>
                                                <th>Mensaje:</th><td>'.$mensaje.'</td>
                                            </tr>
                                           </table>
                                         </body>
                                         </html> ';
                    mail($correoAdmin, $asunto, $estructuraMensaje, $cabeceras);
                }else{ echo parsinJson(false, "El mensaje es requerido"); }
            }else{
                echo parsinJson(false, "El asunto es requerido");
            }
        }else{
            echo parsinJson(false, "El correo/teléfono es requerido");
        }
    }else{
        echo parsinJson(false, "El nombre es requerido");
    }

    function parsinJson($status, $mensaje){
        return json_encode(['estatus'=>$status, 'mensaje'=>$mensaje]);
    }
