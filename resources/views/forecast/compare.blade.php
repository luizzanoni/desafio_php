<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Histórico</h1>
    <table>
        <thead>
            <tr>
                <th>CEP</th>
                <th>Localidade</th>
                <th>Temperatura</th>
                <th id="selectHeader">Selecionar</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            @foreach ($forecast as $forecasts)
            <tr>
                <td>{{ $forecasts->cep }}</td>
                <td>{{ $forecasts->localidade }}</td>
                <td>{{ $forecasts->temperatura }}</td>
                <td onclick="BuscarPorCidade(`{{ $forecasts->localidade }}`)">
                    <button>Selecionar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="divCamposPrevisao1" class="container mt-5">
        <h1 class="text-left">Previsão do Tempo</h1>
        <p id="mensagem" class="mt-3"></p>
        <div class="row">
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Descrição Tempo:
                </label>
                <input type="text" id="txtDescricaoTempo1" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Temperatura (Cº):
                </label>
                <input type="text" id="txtTemperatura1" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Data e Hora Consulta:
                </label>
                <input type="text" id="txtDataHora1" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Visibilidade:
                </label>
                <input type="text" id="txtVisibilidade1" autocomplete="off" disabled class="form-control text" />
            </div>
        </div>
        <div class="row">
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Vel. Vento (KM/H):
                </label>
                <input type="text" id="txtVelocidadeVento1" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Umidade (%):
                </label>
                <input type="text" id="txtUmidade1" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Pressão do Ar:
                </label>
                <input type="text" id="txtPressaoDoAr1" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Vento Para:
                </label>
                <input type="text" id="txtVentoPara1" autocomplete="off" disabled class="form-control text" />
            </div>
        </div>
    </div>
    <div id="divCamposPrevisao2" class="container mt-5">
        <h1 class="text-left">Previsão do Tempo</h1>
        <p id="mensagem" class="mt-3"></p>
        <div class="row">
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Descrição Tempo:
                </label>
                <input type="text" id="txtDescricaoTempo2" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Temperatura (Cº):
                </label>
                <input type="text" id="txtTemperatura2" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Data e Hora Consulta:
                </label>
                <input type="text" id="txtDataHora2" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Visibilidade:
                </label>
                <input type="text" id="txtVisibilidade2" autocomplete="off" disabled class="form-control text" />
            </div>
        </div>
        <div class="row">
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Vel. Vento (KM/H):
                </label>
                <input type="text" id="txtVelocidadeVento2" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Umidade (%):
                </label>
                <input type="text" id="txtUmidade2" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Pressão do Ar:
                </label>
                <input type="text" id="txtPressaoDoAr2" autocomplete="off" disabled class="form-control text" />
            </div>
            <div class="form-group form-group-sm col-sm-3">
                <label class="control-label">
                    Vento Para:
                </label>
                <input type="text" id="txtVentoPara2" autocomplete="off" disabled class="form-control text" />
            </div>
        </div>
    </div>
    <button onclick="LimparCampos()">Limpar Comparação</button>
</body>

</html>

<script>
    function BuscarPorCidade(localidade) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://api.weatherstack.com/current?access_key=a3001c0826ecfc59c230afa1a662008b&query=' + localidade);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const previsao = JSON.parse(xhr.responseText);
                if (document.getElementById("txtDataHora1").value == "") {
                    document.getElementById("txtDataHora1").value = previsao.location.localtime;
                    document.getElementById("txtUmidade1").value = previsao.current.humidity;
                    document.getElementById("txtDescricaoTempo1").value = previsao.current.weather_descriptions[0];
                    document.getElementById("txtPressaoDoAr1").value = previsao.current.pressure;
                    document.getElementById("txtVisibilidade1").value = previsao.current.visibility;
                    document.getElementById("txtTemperatura1").value = previsao.current.temperature;
                    document.getElementById("txtVentoPara1").value = previsao.current.wind_dir;
                    document.getElementById("txtVelocidadeVento1").value = previsao.current.wind_speed;
                } else {
                    document.getElementById("txtDataHora2").value = previsao.location.localtime;
                    document.getElementById("txtUmidade2").value = previsao.current.humidity;
                    document.getElementById("txtDescricaoTempo2").value = previsao.current.weather_descriptions[0];
                    document.getElementById("txtPressaoDoAr2").value = previsao.current.pressure;
                    document.getElementById("txtVisibilidade2").value = previsao.current.visibility;
                    document.getElementById("txtTemperatura2").value = previsao.current.temperature;
                    document.getElementById("txtVentoPara2").value = previsao.current.wind_dir;
                    document.getElementById("txtVelocidadeVento2").value = previsao.current.wind_speed;
                }
            }
        };
        xhr.send();
    }

    function LimparCampos() {
        document.getElementById("txtDataHora1").value = "";
        document.getElementById("txtUmidade1").value = "";
        document.getElementById("txtDescricaoTempo1").value = "";
        document.getElementById("txtPressaoDoAr1").value = "";
        document.getElementById("txtVisibilidade1").value = "";
        document.getElementById("txtTemperatura1").value = "";
        document.getElementById("txtVentoPara1").value = "";
        document.getElementById("txtVelocidadeVento1").value = "";

        document.getElementById("txtDataHora2").value = "";
        document.getElementById("txtUmidade2").value = "";
        document.getElementById("txtDescricaoTempo2").value = "";
        document.getElementById("txtPressaoDoAr2").value = "";
        document.getElementById("txtVisibilidade2").value = "";
        document.getElementById("txtTemperatura2").value = "";
        document.getElementById("txtVentoPara2").value = "";
        document.getElementById("txtVelocidadeVento2").value = "";
    }
</script>