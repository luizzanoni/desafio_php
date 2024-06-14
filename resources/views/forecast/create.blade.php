<h3>Novo cep/busca</h3>

<form action="{{route('forecast.store')}}" method="POST">
    @csrf()
    <input type="text" onchange="BuscarApiCep()" id="txtCep" name="cep" placeholder="cep">
    <input type="text" name="localidade" id="txtLocalidade" placeholder="localidade">
    <input style="display:none;" id="temperatura" type="text" name="temperatura" placeholder="temperatura">
    <button type="submit">Enviar FORM</button>
</form>

<button onclick="BuscarPrevisaoTempo()">Enviar</button>
<div id="divCamposPrevisao" class="container mt-5">
    <h1 class="text-left">Previsão do Tempo</h1>
    <p id="mensagem" class="mt-3"></p>
    <div class="row">
        <div class="form-group form-group-sm col-sm-3">
            <label class="control-label">
                Descrição Tempo:
            </label>
            <input type="text" id="txtDescricaoTempo" autocomplete="off" disabled class="form-control text" />
        </div>
        <div class="form-group form-group-sm col-sm-3">
            <label class="control-label">
                Temperatura (Cº):
            </label>
            <input type="text" id="txtTemperatura" autocomplete="off" disabled class="form-control text" />
        </div>
        <div class="form-group form-group-sm col-sm-3">
            <label class="control-label">
                Data e Hora Consulta:
            </label>
            <input type="text" id="txtDataHora" autocomplete="off" disabled class="form-control text" />
        </div>
        <div class="form-group form-group-sm col-sm-3">
            <label class="control-label">
                Visibilidade:
            </label>
            <input type="text" id="txtVisibilidade" autocomplete="off" disabled class="form-control text" />
        </div>
    </div>
    <div class="row">
        <div class="form-group form-group-sm col-sm-3">
            <label class="control-label">
                Vel. Vento (KM/H):
            </label>
            <input type="text" id="txtVelocidadeVento" autocomplete="off" disabled class="form-control text" />
        </div>
        <div class="form-group form-group-sm col-sm-3">
            <label class="control-label">
                Umidade (%):
            </label>
            <input type="text" id="txtUmidade" autocomplete="off" disabled class="form-control text" />
        </div>
        <div class="form-group form-group-sm col-sm-3">
            <label class="control-label">
                Pressão do Ar:
            </label>
            <input type="text" id="txtPressaoDoAr" autocomplete="off" disabled class="form-control text" />
        </div>
        <div class="form-group form-group-sm col-sm-3">
            <label class="control-label">
                Vento Para:
            </label>
            <input type="text" id="txtVentoPara" autocomplete="off" disabled class="form-control text" />
        </div>
    </div>
</div>


<script language="JavaScript">
    var div = document.getElementById('divCamposPrevisao');
    div.style.display = 'none';

    function BuscarApiCep() {
        var cep = document.getElementById('txtCep').value;
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const dados = JSON.parse(xhr.responseText);
                if (dados.erro) {
                    alert("CEP não encontrado. Tente novamente!");
                    document.getElementById("txtCep").value = "";
                    document.getElementById("txtLocalidade").value = "";
                    $("#divCamposPrevisao").hide();
                } else {
                    document.getElementById("txtCep").value = dados.cep;
                    document.getElementById("txtLocalidade").value = dados.localidade;
                }
            }
        };
        xhr.send();
    }

    function BuscarPrevisaoTempo() {
        var localidade = document.getElementById("txtLocalidade").value;
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://api.weatherstack.com/current?access_key=a3001c0826ecfc59c230afa1a662008b&query=' + localidade);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const previsao = JSON.parse(xhr.responseText);
                if (previsao.erro) {
                    alert("Cidade não encontrada!");
                    document.getElementById("txtCep").value = "";
                    document.getElementById("txtLocalidade").value = "";
                    var div = document.getElementById('divCamposPrevisao');
                    div.style.display = 'none';
                } else {
                    var div = document.getElementById('divCamposPrevisao');
                    div.style.display = 'block';
                    console.log(previsao)
                    document.getElementById("txtDataHora").value = previsao.location.localtime;
                    document.getElementById("txtUmidade").value = previsao.current.humidity;
                    document.getElementById("txtDescricaoTempo").value = previsao.current.weather_descriptions[0];
                    document.getElementById("txtPressaoDoAr").value = previsao.current.pressure;
                    document.getElementById("txtVisibilidade").value = previsao.current.visibility;
                    document.getElementById("txtTemperatura").value = previsao.current.temperature;
                    document.getElementById("temperatura").value = previsao.current.temperature;
                    document.getElementById("txtVentoPara").value = previsao.current.wind_dir;
                    document.getElementById("txtVelocidadeVento").value = previsao.current.wind_speed;
                }
            }
        };
        xhr.send();
    }
</script>