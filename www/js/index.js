const urlDoArquivoJSON = '../www/json/brazil-cities-states-en.json';
const AlertErr = $("#AlertErr");
const AlertTxt = $("#ErrText");

$(document).ready(function () {
  carregarJSON(urlDoArquivoJSON, (data) => {
    popularEstados(data);
    document.getElementById('estados').addEventListener('change', () => popularCidades(data));
  });

  $('#getClima').submit(function (event) {
    event.preventDefault();

    var email = $('#emailTxt').val == "" ? $('#emailTxt').val : null;
    var cidade = $('#cidades').val();


    if (!cidade) {
      console.error('Por favor, selecione uma cidade.');
      return;
    }


    var formData = {
      cidade: cidade,
      email: email
    };

    console.log(formData);

    $.ajax({
      type: 'POST',
      url: 'http://localhost:8080/index.php?action=getWeather',
      data: formData,
      success: function (response) {

        console.log(response);

        $("#Vento").html("");
        $("#Temperatura").html("");

        $("#Vento").append(`<span class="title" id="velocidadeVento">
        </span>Kilometros por
        hora`);

        $('#velocidadeVento').text(parseFloat(response.clima.vento.toFixed(2)) + " ");

        $("#Temperatura").append(` Min: <span class="title" id="tempMin">
        </span>Max: <span class="title" id="tempMax">
        </span></p>Atual: <span class="title" id="tempAtual">
    </span>`);

        $('#tempMin').text(response.clima.min + "° ");
        $('#tempMax').text(response.clima.max + "° ");

        $('#tempAtual').text(response.clima.temperatura + "° ");

        $("#Umidade").append(`<span class="title" id="umidadeAtual"></span>`);

        $('#umidadeAtual').text(response.clima.umidade + "% ");

        $("#Descricao").append(`<span class="title" id="DescricaoAtual"></span>`);

        $('#DescricaoAtual').text(response.clima.descricao);

        var iconUrl = "https://openweathermap.org/img/wn/" + response.clima.icon + "@2x.png";
        $('#weatherIcon').attr('src', iconUrl);

      },
      error: function (xhr, status, error) {
        console.error('Erro ao enviar a mensagem: ', status, error);
        console.error('Resposta do servidor: ', xhr.responseText);

        AlertErr.css('display', 'flex');
        AlertTxt.text("Cidade inexistente");
        setTimeout(() => {

          AlertErr.css('display', 'none');

        }, 5000);

      }
    });
  });
});

function carregarJSON(url, callback) {
  fetch(url)
    .then(response => {
      if (!response.ok) {
        AlertErr.css('display', 'flex');
        AlertTxt.text("Erro ao carregar o JSON");
        setTimeout(() => {

          AlertErr.css('display', 'none');

        }, 5000);
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