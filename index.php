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
                            <input type="email" class="form-control email-form hidden" id="emailTxt"
                                placeholder="Insira seu email">
                        </div>

                        <div class="col-md-12  ">
                            <div class="form-group d-flex test">
                                <input type="submit" value="Pesquisar clima" class="btn btn-dark botao-enviar"
                                    id="botaoEnviar">
                                <div class="loading hidden" id="load"></div>
                            </div>
                        </div>
                </div>
                </form>
            </div>

            <div class="col-md-5 d-flex align-items-stretch">
                <div class="error" id="AlertErr">
                    <div class="error__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="2 2 22 22" height="24" fill="none"
                            style="margin-bottom: 5px;">
                            <path fill="#393a37"
                                d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z">
                            </path>
                        </svg>
                    </div>
                    <div class="error__title" id="ErrText">lorem ipsum dolor sit amet</div>
                </div>
                <div class="success" id="AlertSucs">
                    <div class="error__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="2 2 22 22" height="24" fill="none"
                            style="margin-bottom: 5px;">
                            <path fill="#393a37"
                                d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z">
                            </path>
                        </svg>
                    </div>
                    <div class="error__title" id="SucsTxt">lorem ipsum dolor sit amet</div>
                </div>
                <div class="info-wrap bg-dark w-100 p-lg-5 p-4">

                    <h3 class="mb-4 mt-md-4">Clima</h3>
                    <div class="dbox w-100 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <svg width="800px" height="800px" viewBox="-4 -3 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.5 15.5C13.2164 14.3589 11.981 13.5 10.5 13.5C9.019 13.5 7.78364 14.3589 7.5 15.5M21 5V7M21 11V13M21 17V19M6.2 21H14.8C15.9201 21 16.4802 21 16.908 20.782C17.2843 20.5903 17.5903 20.2843 17.782 19.908C18 19.4802 18 18.9201 18 17.8V6.2C18 5.0799 18 4.51984 17.782 4.09202C17.5903 3.71569 17.2843 3.40973 16.908 3.21799C16.4802 3 15.9201 3 14.8 3H6.2C5.0799 3 4.51984 3 4.09202 3.21799C3.71569 3.40973 3.40973 3.71569 3.21799 4.09202C3 4.51984 3 5.07989 3 6.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21ZM11.5 9.5C11.5 10.0523 11.0523 10.5 10.5 10.5C9.94772 10.5 9.5 10.0523 9.5 9.5C9.5 8.94772 9.94772 8.5 10.5 8.5C11.0523 8.5 11.5 8.94772 11.5 9.5Z"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="text pl-3 ">
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
                            <p id=""><span class="title">Umidade: </span> <span id="Umidade"></span> </p>
                        </div>
                    </div>
                    <div class="dbox w-100 d-flex align-items-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px"
                                viewBox="-90 -80 700 700" xml:space="preserve">

                                <g>
                                    <path class="st0" d="M506.391,287.074c-3.578-10.219-13.484-22-20.734-29.047c-17.188-16.672-35.688-25-44.75-29.875
		c-6.75-4.047-15.313-1.594-19.188,5.484c-3.844,7.063-1.313,15.703,5.219,20.141c42.844,29.234,49.906,64.281,18.906,100.859
		c-9.266,10.922-21.641,19.563-39.813,29.75c-29.734,16.656-91.094,31.313-150.031,31.234
		c-58.938,0.078-120.297-14.578-150.031-31.234c-18.156-10.188-30.531-18.828-39.813-29.75c-31-36.578-23.938-71.625,18.938-100.859
		c6.5-4.438,9.047-13.078,5.188-20.141c-3.844-7.078-12.438-9.531-19.156-5.484c-9.078,4.875-27.594,13.203-44.75,29.875
		c-7.281,7.047-17.188,18.828-20.75,29.047C2.047,297.262,0,308.402,0,320.027c0,12.016,2.25,23.766,6.375,34.719
		c7.219,19.203,19.766,35.828,35.563,50.047c23.781,21.313,55.188,37.719,91.656,49.219c36.484,11.453,78.125,17.844,122.406,17.844
		s85.922-6.391,122.406-17.844c36.469-11.5,67.875-27.906,91.656-49.219c15.797-14.219,28.359-30.844,35.563-50.047
		c4.125-10.953,6.391-22.703,6.375-34.719C512.016,308.402,509.953,297.262,506.391,287.074z" />
                                    <path class="st0" d="M239.5,314.074c7.031,15.563,15.969,25.781,22.75,31.281c6.906,5.516,12.406,7.266,16.656,4.859
		c4.281-2.406,5.188-8.484,3.594-17.016c-1.594-8.578-5.156-18.859-7.609-31.172c-2.516-12.188-4.203-27.906-4.203-45.328
		c0.063-8.547,0.719-17.094,2.438-25.578c1.688-8.531,4.594-17.016,8.547-27.516c3.953-10.438,8.203-22.75,10.297-35.031
		c2.188-12.313,2.531-24.234,1.953-35.094c-1.328-21.406-5.563-40.516-12.594-56.141c-7.016-15.578-15.984-25.781-22.766-31.281
		c-6.906-5.516-12.406-7.266-16.656-4.859c-4.281,2.406-5.172,8.5-3.563,17.016c1.594,8.594,5.156,18.859,7.609,31.172
		c2.516,12.172,4.203,27.906,4.203,45.313c-0.063,8.547-0.719,17.094-2.438,25.578c-1.688,8.531-4.594,17.016-8.563,27.516
		c-3.953,10.453-8.188,22.75-10.281,35.063c-2.188,12.297-2.563,24.219-1.953,35.078C228.234,279.34,232.469,298.449,239.5,314.074z
		" />
                                    <path class="st0" d="M329.094,278.465c2.063,8.656,4.938,16.734,8.438,23.719c7.094,14.141,15.938,22.828,22.469,27.266
		c6.688,4.453,12,5.531,16.141,2.922s5.016-8.344,3.469-16.063c-1.516-7.781-4.906-16.797-7.109-27.313
		c-2.281-10.375-3.781-24-3.563-39.078c0.156-7.359,0.906-14.578,2.625-21.703c1.719-7.172,4.578-14.344,8.594-23.563
		c3.969-9.141,8.453-20.219,10.813-31.547c2.438-11.328,3-22.438,2.516-32.438c-0.516-10.047-1.859-19.016-3.922-27.719
		c-2.063-8.641-4.938-16.719-8.453-23.703c-7.078-14.156-15.922-22.844-22.469-27.266c-6.688-4.453-12-5.531-16.141-2.922
		s-5,8.328-3.469,16.063c1.531,7.766,4.922,16.797,7.125,27.297c2.281,10.375,3.781,24,3.563,39.063
		c-0.188,7.359-0.922,14.578-2.656,21.703c-1.719,7.172-4.594,14.344-8.594,23.578c-4,9.141-8.469,20.234-10.813,31.563
		c-2.438,11.344-2.984,22.438-2.5,32.422C325.688,260.793,327.031,269.762,329.094,278.465z" />
                                    <path class="st0" d="M129.625,278.465c2.063,8.656,4.938,16.734,8.469,23.719c7.094,14.141,15.906,22.828,22.469,27.266
		c6.688,4.453,12,5.531,16.125,2.922c4.156-2.609,5.016-8.344,3.469-16.063c-1.516-7.766-4.906-16.797-7.125-27.313
		c-2.281-10.375-3.781-24-3.563-39.078c0.172-7.359,0.922-14.578,2.656-21.703c1.703-7.172,4.547-14.344,8.578-23.563
		c3.984-9.141,8.453-20.219,10.797-31.547c2.453-11.328,3.016-22.438,2.516-32.438c-0.516-10.047-1.859-19-3.891-27.719
		c-2.063-8.641-4.969-16.719-8.469-23.703c-7.094-14.141-15.938-22.844-22.469-27.281c-6.688-4.453-12-5.516-16.156-2.906
		c-4.125,2.609-5,8.328-3.438,16.063c1.516,7.766,4.891,16.781,7.094,27.297c2.281,10.375,3.781,24,3.563,39.063
		c-0.188,7.359-0.922,14.578-2.656,21.703c-1.719,7.172-4.563,14.344-8.594,23.578c-3.969,9.141-8.453,20.234-10.813,31.563
		c-2.422,11.328-2.984,22.438-2.484,32.422C126.25,260.793,127.578,269.762,129.625,278.465z" />
                                </g>
                            </svg>
                        </div>
                        <div class="text pl-3">
                            <p id=""><span class="title">Sensação termica: </span> <span id="Sensasao"></span> </p>
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