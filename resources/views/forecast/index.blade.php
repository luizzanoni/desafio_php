<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<a href="{{ Route('forecast.create')}}">Buscar CEP</a>

<a href="{{ Route('forecast.compare')}}">Comparar Previsão</a>

<body>
    <h1>Histórico</h1>
    <table>
        <thead>
            <tr>
                <th>CEP</th>
                <th>Localidade</th>
                <th>Temperatura</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($forecast as $forecasts)
            <tr>
                <td>{{ $forecasts->cep }}</td>
                <td>{{ $forecasts->localidade }}</td>
                <td>{{ $forecasts->temperatura }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>