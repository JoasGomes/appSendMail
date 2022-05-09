<?php

    require "./bibliotecas/PHPMailer-6.0.0/src/Exception.php";
    require "./bibliotecas/PHPMailer-6.0.0/src/OAuth.php";
    require "./bibliotecas/PHPMailer-6.0.0/src/PHPMailer.php";
    require "./bibliotecas/PHPMailer-6.0.0/src/POP3.php";
    require "./bibliotecas/PHPMailer-6.0.0/src/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //print_r($_POST);

    class Mensagem {
        //variáveis que vão conter os dados do form
        private $para = null;
        private $assunto = null;
        private $mensagem = null;

        public function __get($atributo){
            return $this->$atributo;
        }

        //função para setar os valores do form para as variáveis
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        //testando se a msg é valida 
        public function mensagemValida(){
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
                return false;
            }

            return true;
        }
    }

    $mensagem = new Mensagem();

    //setando os valores do form para as variáveis do doc php
    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    //print_r($mensagem);

    if(!$mensagem->mensagemValida()){
        echo 'mensagem não é valida';
        die();
    }

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp-relay.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'webcompleto2@gmail.com';                 // SMTP username
        $mail->Password = '!@#$4321';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('webcompleto2@gmail.com', 'web completo remetente');
        $mail->addAddress('webcompleto2@gmail.com', 'web completo destinatário');     // Add a recipient
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'oi. eu sou o assunto!';
        $mail->Body    = 'oi. eu sou o conteúdo do <strong>e-mail</strong>.';
        $mail->AltBody = 'oi. eu sou o conteúdo do e-mail.';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Não foi possível enviar este email! Por favor,tente novamente.';
        echo 'Detalhes do erro: ' . $mail->ErrorInfo;
    }





?>