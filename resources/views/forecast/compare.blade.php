<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <a href="{{ Route('forecast.index')}}">Voltar</a>
</body>

</html>

<script>
    function BuscarPorCidade(localidade) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://api.weatherstack.com/current?access_key=921e05a0f4de567e2c5af5c713eca96f&query=' + localidade);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const previsao = JSON.parse(xhr.responseText);
                console.log(previsao)
                if ($("#txtDataHora1").val() == "") {
                    $("#txtDataHora1").val(previsao.location.localtime);
                    $("#txtUmidade1").val(previsao.current.humidity);
                    $("#txtDescricaoTempo1").val(previsao.current.weather_descriptions[0]);
                    $("#txtPressaoDoAr1").val(previsao.current.pressure);
                    $("#txtVisibilidade1").val(previsao.current.visibility);
                    $("#txtTemperatura1").val(previsao.current.temperature);
                    $("#txtVentoPara1").val(previsao.current.wind_dir);
                    $("#txtVelocidadeVento1").val(previsao.current.wind_speed);
                } else {
                    $("#txtDataHora2").val(previsao.location.localtime);
                    $("#txtUmidade2").val(previsao.current.humidity);
                    $("#txtDescricaoTempo2").val(previsao.current.weather_descriptions[0]);
                    $("#txtPressaoDoAr2").val(previsao.current.pressure);
                    $("#txtVisibilidade2").val(previsao.current.visibility);
                    $("#txtTemperatura2").val(previsao.current.temperature);
                    $("#txtVentoPara2").val(previsao.current.wind_dir);
                    $("#txtVelocidadeVento2").val(previsao.current.wind_speed);
                }
            }
        };
        xhr.send();
    }

    function LimparCampos() {
        $("#txtDataHora1").val();
        $("#txtUmidade1").val();
        $("#txtDescricaoTempo1").val();
        $("#txtPressaoDoAr1").val();
        $("#txtVisibilidade1").val();
        $("#txtTemperatura1").val();
        $("#txtVentoPara1").val();
        $("#txtVelocidadeVento1").val();
        $("#txtDataHora2").val();
        $("#txtUmidade2").val();
        $("#txtDescricaoTempo2").val();
        $("#txtPressaoDoAr2").val();
        $("#txtVisibilidade2").val();
        $("#txtTemperatura2").val();
        $("#txtVentoPara2").val();
        $("#txtVelocidadeVento2").val();
    }
</script>