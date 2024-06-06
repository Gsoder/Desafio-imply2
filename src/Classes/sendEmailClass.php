<?php

namespace Imply\DesafioImply2\Classes;

use Imply\DesafioImply2\Model\historicoModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        header('Content-Type: text/html; charset=UTF-8');
        try {
            $mail = new PHPMailer(true); 
            $mail->isSMTP();
            $mail->Host = $this->Host;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Username = $this->Username;
            $mail->Password = $this->Password;
            $mail->Port = $this->Port;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom($this->Username, "Sua requisição do clima chegou!!!");
            $mail->addAddress($this->Email, "Test");

            $iconUrl = "https://openweathermap.org/img/wn/" . $this->historico->getClimaID()->getIcon() . "@2x.png";

            $mail->isHTML(true);
            $mail->Subject = "Obtenção do clima de " . $this->historico->getCidade();
            $mail->Body = "<h1 style='color: #3498db;'>Nova previsão do tempo</h1>" .
                "<p style='color: #2c3e50;'><strong>Temperatura:</strong> " . $this->historico->getClimaID()->getTemperatura() . "C° </p>" .
                "<p style='color: #2c3e50;'><strong>Umidade:</strong> " . $this->historico->getClimaID()->getUmidade() . "% </p>" .
                "<p style='color: #2c3e50;'><strong>Min:</strong> " . $this->historico->getClimaID()->getMin() . "C° </p>" .
                "<p style='color: #2c3e50;'><strong>Max:</strong> " . $this->historico->getClimaID()->getMax() . "C° </p>" .
                "<p style='color: #2c3e50;'><strong>Vento:</strong> " . $this->historico->getClimaID()->getVento() . "KM/H </p>" .
                "<div style='display: flex'><p style='color: #2c3e50;'><strong>Descrição:</strong> " . $this->historico->getClimaID()->getDescricao() . " </p><img src='" . $iconUrl . "'>";

            $mail->send();
            return 'Mensagem enviada.';
        } catch (Exception $e) {
            return 'Não foi possível enviar a mensagem. Erro: ' . $mail->ErrorInfo;
        }

    }
    

}