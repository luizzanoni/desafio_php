<h3>Novo cep/busca</h3>

<form action="{{route('forecast.store')}}" method="POST">
    @csrf()
    <button type="submit">Voltar</button>
    <div class="row">
        <input type="text" onchange="BuscarApiCep()" id="txtCep" name="cep" placeholder="cep">
        <input type="text" name="localidade" id="txtLocalidade" placeholder="localidade">
        <input style="display:none;" id="temperatura" type="text" name="temperatura" placeholder="temperatura">
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<button onclick="BuscarPrevisaoTempo()">Buscar Previsão</button>
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
    $("#divCamposPrevisao").hide();

    function Cadastrar() {
        BuscarPrevisaoTempo().then(
            $('#formForecast').on('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    }).then(response => {
                        if (!response.ok) {
                            console.log('Aconteceu Algo de Errado');
                        }
                        return {
                            message: 'cadastrado'
                        }
                    })
                    .then(data => {
                        alert(data.message);
                    })
                    .catch(error => {
                        console.log('Error: ', error);
                    });
            })
        );
    }

    function BuscarApiCep() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://viacep.com.br/ws/' + $("#txtCep").val() + '/json/');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const dados = JSON.parse(xhr.responseText);
                if (dados.erro) {
                    alert("CEP não encontrado. Tente novamente!");
                    $("#txtCep").val("")
                    $("#txtLocalidade").val("");
                    $("#divCamposPrevisao").hide();
                } else {
                    $("#txtCep").val(dados.cep)
                    $("#txtLocalidade").val(dados.localidade);
                }
            }
        };
        xhr.send();
    }
    function BuscarPrevisaoTempo() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://api.weatherstack.com/current?access_key=921e05a0f4de567e2c5af5c713eca96f&query=' + $("#txtLocalidade").val());
        xhr.onload = function() {
            if (xhr.status === 200) {
                const previsao = JSON.parse(xhr.responseText);
                if (previsao.erro) {
                    alert("Cidade não encontrada!");
                    $("#txtCep").val("")
                    $("#txtLocalidade").val("");
                    $("#divCamposPrevisao").hide();
                } else {
                    $("#divCamposPrevisao").show();
                    $("#txtDataHora").val(previsao.location.localtime);
                    $("#txtUmidade").val(previsao.current.humidity);
                    $("#txtDescricaoTempo").val(previsao.current.weather_descriptions[0]);
                    $("#txtPressaoDoAr").val(previsao.current.pressure);
                    $("#txtVisibilidade").val(previsao.current.visibility);
                    $("#txtTemperatura").val(previsao.current.temperature);
                    $("#temperatura").val(previsao.current.temperature);
                    $("#txtVentoPara").val(previsao.current.wind_dir);
                    $("#txtVelocidadeVento").val(previsao.current.wind_speed);
                }
            }
        };
        xhr.send();
    }
</script>