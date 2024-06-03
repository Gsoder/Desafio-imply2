<?php

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = 'gabzammoder@gmail.com';
$mail->Password = '20191817gcm';
$mail->Port = 587;

$curl = curl_init();


$url = 'https://api.openweathermap.org/data/2.5/weather?lat=-29.7131&lon=-52.4316&appid=63ebc0939705091b3565c449a4c6f266';


curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


$response = curl_exec($curl);


curl_close($curl);

$mail->setFrom('gabzammoder@gmail.com');
$mail->addAddress('gabzamsoder@gmail.com');
$mail->isHTML(true);
$mail->Subject = 'Assunto do email';
$mail->Body    = $response;
if(!$mail->send()) {
    echo 'Não foi possível enviar a mensagem.<br>';
    echo 'Erro: ' . $mail->ErrorInfo;
} else {
    echo 'Mensagem enviada.';
}

