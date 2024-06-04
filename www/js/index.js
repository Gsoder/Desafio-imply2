const urlDoArquivoJSON = '../www/json/brazil-cities-states-en.json';

$(document).ready(function () {
  carregarJSON(urlDoArquivoJSON, (data) => {
    popularEstados(data);
    document.getElementById('estados').addEventListener('change', () => popularCidades(data));
  });

  $('#getClima').submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      url: '../src/Controller/mainController.php/handleRequest?action=getWeather',
      data: formData,
      success: function (response) {
        console.log(response);
      },
      error: function () {
        console.log('Erro ao enviar a mensagem. Por favor, tente novamente.');
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
  if ($('#emailTxt').css('display') == 'none') {
    console.log("test");
    $(this).css({
      display: flex
    })

  } else {
    $(this).addClass('form-control');
  }

}