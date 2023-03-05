<?php
include_once '../modelo/usuario.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



//Load Composer's autoloader
require_once('../vendor/autoload.php') ;
$usuario = new usuario();
if($_POST['funcion']=='verificar'){
    $email = $_POST['email'];
    $ci=$_POST['ci'];
    $usuario->verificar($email,$ci);

}


if($_POST['funcion']=='recuperar'){
    $email = $_POST['email'];
    $ci=$_POST['ci'];
    $codigo=generar(10);
    //echo $codigo;
    $usuario->reemplazar($codigo,$email,$ci);
    $mail = new PHPMailer(true);

try {
      //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'ssl://smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->UserName   = 'farmacialaglorieta1@hotmail.com';                     //SMTP username
    $mail->Password   = 'laglorieta1';                               //SMTP  password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`  
/*     $mail->SMTPDebug = 4;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'ssl://smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->UserName   = 'nata10adri@gmail.com';                     //SMTP username
    $mail->Password   = 'fernandez.';                               //SMTP  password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                      
 */

   
    //Recipients
    //$mail->setFrom('farmacialaglorieta1@hotmail.com', 'Sistema de control farmacia la glorieta ');
     $mail->setFrom('nata10adri@gmail.com', 'Sistema de control farmacia la glorieta '); 
    $mail->addAddress($email);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Restablecer contraseña';
    $mail->Body    = 'La nueva contraseña es: <b>'.$codigo.'</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->SMTPDebug = false;
    $mail->do_debug=false;
   
    $mail->send();
    echo 'enviado';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
 
    
}

function generar($longitud){
    $key='';
    $patron='1234567890abcdefghijklmnopqrstuvwxyz';
    $max=strlen($patron)-1;
    for($i=0;$i<$longitud;$i++){
        $key.=$patron{mt_rand(0,$max)};

    }
    return $key;


}

?>