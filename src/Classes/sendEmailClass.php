<?php

namespace Imply\DesafioImply2\Classes;

use Imply\DesafioImply2\Model\historicoModel;
use PHPMailer\PHPMailer\PHPMailer;

class sendEmailClass
{
    private historicoModel $historico;
    private string $Host;
    private string $Username;
    private string $Password;
    private int $Port;
    private string $Email;

    public function __construct(historicoModel $historico, string $email)
    {
        $this->historico = $historico;
        $this->Host = 'smtp.gmail.com';
        $this->Username = 'gabzamsoder@gmail.com';
        $this->Password = 'mspbkuwfoxfvwkso';
        $this->Port = 465;
        $this->Email = $email;
    }


    public function Send(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $this->Host;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = $this->Username;
        $mail->Password = $this->Password;
        $mail->Port = $this->Port;

        $mail->setFrom($this->Username, "Sua requisição do clima chegou!!!");
        $mail->addAddress($this->Email, "Test");

        $mail->isHTML(true);
        
        $mail->Subject = "Obtenção do clima de " . $this->historico->getCidade();

        $mail->Body    = "<h1 style='color: #3498db;'>Nova mensagem de reserva</h1>" +
        "<p style='color: #2c3e50;'><strong>Temperatura:</strong>" . $this->historico->getClimaID()->getTemperatura() . " </p>" +
        "<p style='color: #2c3e50;'><strong>Umidade:</strong> " . $this->historico->getClimaID()->getUmidade() . " </p>" +
        "<p style='color: #2c3e50;'><strong>Min:</strong> " . $this->historico->getClimaID()->get() . " </p>" +
        "<p style='color: #2c3e50;'><strong>Max:</strong> " . $this->historico->getClimaID()->getTemperatura() . " </p>" +
        "<p style='color: #2c3e50;'><strong>Vento:</strong> " . $this->historico->getClimaID()->getTemperatura() . " </p>" +
        "<p style='color: #2c3e50;'><strong>Descrição:</strong> " . $this->historico->getClimaID()->getTemperatura() . " </p>" +
        "<p style='color: #2c3e50;'><strong>Icon:</strong> " . $this->historico->getClimaID()->getTemperatura() . " </p>";

        if(!$mail->send()) {
            echo 'Não foi possível enviar a mensagem.<br>';
            echo 'Erro: ' . $mail->ErrorInfo;
        } else {
            echo 'Mensagem enviada.';
        }

    }
    

}