<?php

require './bibliotecas/PHPMailer-7.0.0/src/Exception.php';
require './bibliotecas/PHPMailer-7.0.0/src/PHPMailer.php';
require './bibliotecas/PHPMailer-7.0.0/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Define que a resposta será um JSON (para o JavaScript ler)
header('Content-Type: application/json');

class Mensagem {
    private $para = null;
    private $assunto = null;
    private $mensagem = null;
    public $status = array('codigo_status' => null, 'descricao_status' => null);

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $vlor) {
        $this->$atributo = $vlor;
    }

    public function mensagemValida() {
        if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
            return false;
        }
        return true;
    }
}

$mensagem = new Mensagem();
$mensagem->__set('para', $_POST['para']);
$mensagem->__set('assunto', $_POST['assunto']);
$mensagem->__set('mensagem', $_POST['mensagem']);

// Validação básica
if(!$mensagem->mensagemValida()) {
    echo json_encode(['status' => 'error', 'message' => 'Preencha todos os campos!']);
    exit; // Para a execução
}

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'carlosanderson30030@gmail.com';                     
    $mail->Password   = 'cxva ftth llps gluf'; // CUIDADO: Em produção, use variáveis de ambiente!                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom('carlosanderson30030@gmail.com', 'App Mail Send');
    $mail->addAddress($mensagem->__get('para'));     

    //Content
    $mail->isHTML(true);                                  
    $mail->Subject = $mensagem->__get('assunto');
    $mail->Body    = $mensagem->__get('mensagem');
    $mail->AltBody = strip_tags($mensagem->__get('mensagem'));

    $mail->send();

    // Retorna Sucesso em JSON
    echo json_encode([
        'status' => 'success', 
        'message' => 'E-mail enviado com sucesso!'
    ]);

} catch (Exception $e) {
    // Retorna Erro em JSON
    echo json_encode([
        'status' => 'error', 
        'message' => 'Não foi possível enviar o e-mail. Detalhes: ' . $mail->ErrorInfo
    ]);
}
?>