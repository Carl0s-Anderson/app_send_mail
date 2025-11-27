<?php
//print_r($_POST);
require './bibliotecas/PHPMailer-7.0.0/src/Exception.php';
require './bibliotecas/PHPMailer-7.0.0/src/PHPMailer.php';
require './bibliotecas/PHPMailer-7.0.0/src/SMTP.php';
//require './bibliotecas/PHPMailer-7.0.0/src/OAuth.php';
//require './bibliotecas/PHPMailer-7.0.0/src/POP3.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mensagem
{
    private $para = null;
    private $assunto = null;
    private $mensagem = null;

    public function __get($atributo)
    {
        return $this->$atributo;
    }
    public function __set($atributo, $vlor)
    {
        $this->$atributo = $vlor;
    }
    public function mensagemValida()
    {
        if (empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
            return false;
        }
        return true;
    }
}
$mensagem = new Mensagem();
$mensagem->__set('para', $_POST['para']);
$mensagem->__set('assunto', $_POST['assunto']);
$mensagem->__set('mensagem', $_POST['mensagem']);


if (!$mensagem->mensagemValida()) {
    echo 'mensagem nao é valida';
    die();
}
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'carlosanderson30030@gmail.com';                     //SMTP username
    $mail->Password   = 'cxva ftth llps gluf';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('carlosanderson30030@gmail.com', 'remetente');
    $mail->addAddress('violeta.gervazio@gmail.com', 'destinatario');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'OI! eu sou o assunto';
    $mail->Body    = 'Quero perguntar-te como foi o teu dia enquanto te masturbo, para que entre gemidos e gaguejes tente falar e explicar-me cada detalhe, até que finalmente goze e, consequentemente, eu possa mencionar o quão bom soou o teu dia para mim.';
    $mail->AltBody = 'teste';

    $mail->send();
    echo 'Ops! O envio falhou. Algo deu errado no caminho — tente novamente mais tarde e não desista, sua mensagem ainda merece chegar ao destino.';
} catch (Exception $e) {
    echo "detalhes do erro: {$mail->ErrorInfo}";
}
//print_r($mensagem);