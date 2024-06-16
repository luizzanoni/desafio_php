<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo CEP/Busca</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto;
            height: 100%;
        }

        .main-container {
            display: flex;
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .container,
        .container-fields {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
            overflow: hidden;
        }

        h3,
        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .row {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            max-width: 400px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 10px;
            display: inline-block;
            background-color: #007BFF;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .container-fields {
            display: none;
            margin-top: 0;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            margin-left: 90px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: 35px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-group {
            flex: 1 1 calc(50% - 20px);
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="container">
            <h3>Novo CEP/Busca</h3>
            <form action="{{route('forecast.store')}}" method="POST">
                @csrf
                <div class="row">
                    <input type="text" onchange="BuscarApiCep()" id="txtCep" name="cep" placeholder="CEP">
                    <input type="text" name="localidade" id="txtLocalidade" placeholder="Localidade">
                    <input style="display:none;" id="temperatura" type="text" name="temperatura" placeholder="Temperatura">
                </div>
                <button id="btnSalvar" type="submit">Salvar</button>
            </form>
            <button onclick="BuscarPrevisaoTempo()">Buscar Previsão</button>
        </div>

        <div id="divCamposPrevisao" class="container-fields">
            <h1>Previsão do Tempo</h1>
            <p id="mensagem"></p>
            <div class="row">
                <div class="form-group">
                    <label>Descrição Tempo:</label>
                    <input type="text" id="txtDescricaoTempo" disabled />
                </div>
                <div class="form-group">
                    <label>Temperatura (Cº):</label>
                    <input type="text" id="txtTemperatura" disabled />
                </div>
                <div class="form-group">
                    <label>Data e Hora Consulta:</label>
                    <input type="text" id="txtDataHora" disabled />
                </div>
                <div class="form-group">
                    <label>Visibilidade:</label>
                    <input type="text" id="txtVisibilidade" disabled />
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Vel. Vento (KM/H):</label>
                    <input type="text" id="txtVelocidadeVento" disabled />
                </div>
                <div class="form-group">
                    <label>Umidade (%):</label>
                    <input type="text" id="txtUmidade" disabled />
                </div>
                <div class="form-group">
                    <label>Pressão do Ar:</label>
                    <input type="text" id="txtPressaoDoAr" disabled />
                </div>
                <div class="form-group">
                    <label>Vento Para:</label>
                    <input type="text" id="txtVentoPara" disabled />
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script language="JavaScript">
        $("#divCamposPrevisao").hide();
        $("#btnSalvar").hide();

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
            $("#divCamposPrevisao").show();
            $("#btnSalvar").show();
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
</body>

</html>