const urlDoArquivoJSON = '../www/json/brazil-cities-states-en.json';

$(document).ready(function () {
  carregarJSON(urlDoArquivoJSON, (data) => {
    popularEstados(data);
    document.getElementById('estados').addEventListener('change', () => popularCidades(data));
  });

  $('#getClima').submit(function (event) {
    event.preventDefault();


    var cidade = $('#cidades').val();


    if (!cidade) {
      console.error('Por favor, selecione uma cidade.');
      return;
    }


    var formData = {
      cidade: cidade
    };

    console.log(formData);

    $.ajax({
      type: 'POST',
      url: 'http://localhost:8080/index.php?action=getWeather',
      data: formData,
      success: function (response) {

        $('#velocidadeVento').text(response.wind.speed + " ");

        $('#tempMin').text(response.main.temp_min + " ");
        $('#tempMax').text(response.main.temp_max + " ");

        $('#tempAtual').text(response.main.temp + " ");
        $('#umidadeAtual').text(response.main.humidity + " ");

      },
      error: function (xhr, status, error) {
        console.error('Erro ao enviar a mensagem: ', status, error);
        console.error('Resposta do servidor: ', xhr.responseText);
      }
    });
  });





});

function carregarJSON(url, callback) {
  fetch(url)
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro ao carregar o JSON');
      }
      return response.json();
    })
    .then(json => callback(json))
    .catch(error => console.error('Falha ao carregar JSON:', error));
}

function popularEstados(data) {
  const selectEstado = document.getElementById('estados');
  data.states.forEach(estado => {
    const option = document.createElement('option');
    option.value = estado.uf;
    option.textContent = estado.name;
    selectEstado.appendChild(option);
  });
}

function popularCidades(data) {
  const selectEstado = document.getElementById('estados');
  const selectCidade = document.getElementById('cidades');
  const estadoSelecionado = selectEstado.value;

  selectCidade.innerHTML = '';

  const estado = data.states.find(estado => estado.uf === estadoSelecionado);
  if (!estado) return;


  document.getElementById('estadoTxt').innerHTML = estado.name + ", ";
  document.getElementById('cidadeTxt').innerHTML = '';

  estado.cities.forEach(cidade => {
    const option = document.createElement('option');
    option.value = cidade;
    option.textContent = cidade;
    selectCidade.appendChild(option);
  });


}

function getCidade(data) {
  document.getElementById("cidadeTxt").innerHTML = data;
}

function trocarDisplayEmail() {
  var emailTxt = $('#emailTxt');
  if ($('#flexCheckDefault').is(':checked')) {
    emailTxt.css('display', 'block');
  } else {
    emailTxt.css('display', 'none');
  }
}