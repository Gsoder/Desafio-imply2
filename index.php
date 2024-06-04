<?php

use Imply\DesafioImply2\Classes\getWeatherClass;

require 'vendor/autoload.php';



$test = new getWeatherClass("63ebc0939705091b3565c449a4c6f266");
$weatherData = $test->getWeather("Santa cruz do sul");
echo var_dump($weatherData['weather'][0]['main']);


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
                                <input type="submit" value="Send Message" class="btn btn-primary">
                                <div class="submitting"></div>
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
                            <p><span class="title">Vento: </span><span class="title"><?=$weatherData['wind']['speed']?>
                                </span>Kilometros por
                                hora
                            </p>
                        </div>
                    </div>
                    <div class="dbox w-100 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <svg width="800px" height="800px" viewBox="0 0 32 32" enable-background="new 0 0 32 32"
                                version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Layer_2" />
                                <g id="Layer_3">
                                    <g>
                                        <path
                                            d="M23,24c0,3.9-3.1,7-7,7s-7-3.1-7-7c0-2.3,1.1-4.4,3-5.7V5c0-2.2,1.8-4,4-4s4,1.8,4,4v13.3    C21.9,19.6,23,21.7,23,24z"
                                            fill="#E92662" />
                                    </g>
                                    <g>
                                        <path
                                            d="M20,24c0,2.2-1.8,4-4,4s-4-1.8-4-4c0-1.9,1.3-3.4,3-3.9V13c0-0.5,0.5-1,1-1s1,0.5,1,1v7.1    C18.7,20.6,20,22.1,20,24z"
                                            fill="#FFC10A" />
                                    </g>
                                    <g>
                                        <path d="M10,17H6c-0.6,0-1-0.4-1-1s0.4-1,1-1h4c0.6,0,1,0.4,1,1S10.6,17,10,17z"
                                            fill="#FFC10A" />
                                    </g>
                                </g>
                                <g id="Layer_4" />
                                <g id="Layer_5" />
                                <g id="Layer_6" />
                                <g id="Layer_7" />
                                <g id="Layer_8" />
                                <g id="Layer_9" />
                                <g id="Layer_10" />
                                <g id="Layer_11" />
                                <g id="Layer_12" />
                                <g id="Layer_13" />
                                <g id="Layer_14" />
                                <g id="Layer_15" />
                                <g id="Layer_16" />
                                <g id="Layer_17" />
                                <g id="Layer_18" />
                                <g id="Layer_19" />
                                <g id="Layer_20" />
                                <g id="Layer_21" />
                                <g id="Layer_22" />
                                <g id="Layer_23" />
                                <g id="Layer_24" />
                                <g id="Layer_25" />
                                <g id="Wearher" />
                            </svg>
                        </div>
                        <div class="text pl-3">
                            <p><span class="title">Temperatura: </span>Min: <span
                                    class="title"><?=$weatherData['main']['temp_min']?>° </span>Max: <span
                                    class="title"><?=$weatherData['main']['temp_max']?>°
                                </span></p>
                        </div>
                    </div>
                    <div class="dbox w-100 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <svg width="800px" height="800px" viewBox="0 0 32 32" enable-background="new 0 0 32 32"
                                version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Layer_2" />
                                <g id="Layer_3">
                                    <g>
                                        <path
                                            d="M23,24c0,3.9-3.1,7-7,7s-7-3.1-7-7c0-2.3,1.1-4.4,3-5.7V5c0-2.2,1.8-4,4-4s4,1.8,4,4v13.3    C21.9,19.6,23,21.7,23,24z"
                                            fill="#E92662" />
                                    </g>
                                    <g>
                                        <path
                                            d="M20,24c0,2.2-1.8,4-4,4s-4-1.8-4-4c0-1.9,1.3-3.4,3-3.9V13c0-0.5,0.5-1,1-1s1,0.5,1,1v7.1    C18.7,20.6,20,22.1,20,24z"
                                            fill="#FFC10A" />
                                    </g>
                                    <g>
                                        <path d="M10,17H6c-0.6,0-1-0.4-1-1s0.4-1,1-1h4c0.6,0,1,0.4,1,1S10.6,17,10,17z"
                                            fill="#FFC10A" />
                                    </g>
                                </g>
                                <g id="Layer_4" />
                                <g id="Layer_5" />
                                <g id="Layer_6" />
                                <g id="Layer_7" />
                                <g id="Layer_8" />
                                <g id="Layer_9" />
                                <g id="Layer_10" />
                                <g id="Layer_11" />
                                <g id="Layer_12" />
                                <g id="Layer_13" />
                                <g id="Layer_14" />
                                <g id="Layer_15" />
                                <g id="Layer_16" />
                                <g id="Layer_17" />
                                <g id="Layer_18" />
                                <g id="Layer_19" />
                                <g id="Layer_20" />
                                <g id="Layer_21" />
                                <g id="Layer_22" />
                                <g id="Layer_23" />
                                <g id="Layer_24" />
                                <g id="Layer_25" />
                                <g id="Wearher" />
                            </svg>
                        </div>
                        <div class="text pl-3">
                            <p><span class="title">Temperatura atual: </span> <span
                                    class="title"><?=$weatherData['main']['temp']?>°</span>
                        </div>
                    </div>
                    <div class="dbox w-100 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-globe"></span>
                        </div>
                        <div class="text pl-3">
                            <p><span>Website</span> <a href="#">yoursite.com</a></p>
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