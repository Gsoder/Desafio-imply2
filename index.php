<?php

use Imply\DesafioImply2\Controller\mainController;

require 'vendor/autoload.php';

$controller = new mainController();
$controller->handleRequest();


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio dois php OO</title>
    <link rel="stylesheet" type="text/css" href="/node_modules/bootstrap/dist//css//bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/www/styles/index.css">

</head>

<body>

    <!--<img src="https://openweathermap.org/img/wn/04d@2x.png">-->

    <section class="ftco-section">
        <div class="row container" style="margin: auto;">
            <div class="col-md-7 d-flex align-items-stretch">
                <div class="contact-wrap w-100 p-md-5 p-4">
                    <h3 class="mb-4">Descubra o clima</h3>
                    <form method="POST" id="getClima" name="getClima">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                        id="estados" onchange="popularCidades()">
                                        <option value="">Selecione um estado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                        id="cidades" onchange="getCidade(this.value)">
                                        <option value="">Selecione uma cidade</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                    onchange="trocarDisplayEmail()">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Habilitar email
                                </label>
                            </div>
                            <input type="email" class="form-control email-form" id="emailTxt"
                                placeholder="Insira seu email">
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" value="Pesquisar clima" class="btn btn-primary botao-enviar">
                            </div>
                        </div>
                </div>
                </form>
            </div>

            <div class="col-md-5 d-flex align-items-stretch">
                <div class="info-wrap bg-primary w-100 p-lg-5 p-4">
                    <h3 class="mb-4 mt-md-4">Clima</h3>
                    <div class="dbox w-100 d-flex align-items-start">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <svg width="800px" height="800px" viewBox="-4 -3 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.5 15.5C13.2164 14.3589 11.981 13.5 10.5 13.5C9.019 13.5 7.78364 14.3589 7.5 15.5M21 5V7M21 11V13M21 17V19M6.2 21H14.8C15.9201 21 16.4802 21 16.908 20.782C17.2843 20.5903 17.5903 20.2843 17.782 19.908C18 19.4802 18 18.9201 18 17.8V6.2C18 5.0799 18 4.51984 17.782 4.09202C17.5903 3.71569 17.2843 3.40973 16.908 3.21799C16.4802 3 15.9201 3 14.8 3H6.2C5.0799 3 4.51984 3 4.09202 3.21799C3.71569 3.40973 3.40973 3.71569 3.21799 4.09202C3 4.51984 3 5.07989 3 6.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21ZM11.5 9.5C11.5 10.0523 11.0523 10.5 10.5 10.5C9.94772 10.5 9.5 10.0523 9.5 9.5C9.5 8.94772 9.94772 8.5 10.5 8.5C11.0523 8.5 11.5 8.94772 11.5 9.5Z"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="text pl-3">
                            <p><span class="title">Endereço:</span><span id="estadoTxt"
                                    style=" margin: 5px;"></span><span id="cidadeTxt"></span></p>
                        </div>
                    </div>
                    <div class="dbox w-100 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.7639 7C16.3132 6.38625 17.1115 6 18 6C19.6569 6 21 7.34315 21 9C21 10.6569 19.6569 12 18 12H3M8.50926 4.66667C8.87548 4.2575 9.40767 4 10 4C11.1046 4 12 4.89543 12 6C12 7.10457 11.1046 8 10 8H3M11.5093 19.3333C11.8755 19.7425 12.4077 20 13 20C14.1046 20 15 19.1046 15 18C15 16.8954 14.1046 16 13 16H3"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="text pl-3">
                            <p><span class="title">Vento: </span><span id="Vento"></span>
                            </p>
                        </div>
                    </div>
                    <div class="dbox w-100 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <svg fill="#000000" width="800px" height="800px" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">

                                <g id="Temp_High" data-name="Temp High">
                                    <g>
                                        <path
                                            d="M14.863,13.4V4.939a2.929,2.929,0,0,0-.84-2.03,2.859,2.859,0,0,0-2.23-.82,2.948,2.948,0,0,0-2.66,3l.01,8.28a4.755,4.755,0,0,0,1.9,8.46,5.093,5.093,0,0,0,.95.09,4.759,4.759,0,0,0,4.76-4.75A4.684,4.684,0,0,0,14.863,13.4Zm-.48,6.66a3.783,3.783,0,0,1-3.15.78,3.7,3.7,0,0,1-2.92-2.98,3.745,3.745,0,0,1,1.43-3.69.962.962,0,0,0,.39-.77V5.089a1.968,1.968,0,0,1,1.73-2,.66.66,0,0,1,.14-.01,1.878,1.878,0,0,1,1.86,1.86V13.4a.962.962,0,0,0,.39.77,3.742,3.742,0,0,1,.13,5.89Z" />
                                        <path
                                            d="M13.893,17.169a1.89,1.89,0,0,1-3.78,0,1.858,1.858,0,0,1,1.39-1.81V5.4a.5.5,0,0,1,1,0v9.96A1.869,1.869,0,0,1,13.893,17.169Z" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="text pl-3">
                            <p><span class="title">Temperatura:</span><span id="Temperatura"></span></p>
                        </div>
                    </div>
                    <div class="dbox w-100 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 21.5C16.1012 21.5 19.5 18.4372 19.5 14.5714C19.5 12.1555 18.2672 9.71249 16.8732 7.70906C15.4698 5.69214 13.8515 4.04821 12.9778 3.21778C12.4263 2.69364 11.5737 2.69364 11.0222 3.21779C10.1485 4.04821 8.53016 5.69214 7.1268 7.70906C5.73282 9.71249 4.5 12.1555 4.5 14.5714C4.5 18.4372 7.8988 21.5 12 21.5Z"
                                    stroke="#222222" />
                                <path
                                    d="M12 18C11.4747 18 10.9546 17.8965 10.4693 17.6955C9.98396 17.4945 9.54301 17.1999 9.17157 16.8284C8.80014 16.457 8.5055 16.016 8.30448 15.5307C8.10346 15.0454 8 14.5253 8 14"
                                    stroke="#222222" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="text pl-3">
                            <p id="Umidade"><span class="title">Umidade: </span>
                        </div>
                    </div>
                    <div class="dbox w-100 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <img id="weatherIcon" src="https://openweathermap.org/img/wn/10d@2x.png" alt="Weather Icon">
                        </div>

                        <div class="text pl-3">
                            <p><span class="title">Descrição: </span><span id="Descricao"></span> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script type="text/javascript" src="/node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/www/js/index.js"></script>

</html>