<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previsão Tempo</title>
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
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 10px;
            display: inline-block;
            background-color: #007BFF;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #0056b3;
        }

        a i {
            margin-right: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        @media (min-width: 600px) {
            tbody {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 10px;
            }

            tr {
                display: grid;
                grid-template-columns: 1fr;
                border: 1px solid #ddd;
                border-radius: 5px;
                margin-bottom: 10px;
                background-color: #fff;
                padding: 10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                transition: box-shadow 0.3s;
            }

            tr:hover {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            td {
                border: none;
                padding: 5px 0;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                margin-bottom: 5px;
                color: #666;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Busque ou Compare Previsões de tempo! <i class="fas fa-cloud-sun"></i></h1>
        <a href="{{ Route('forecast.create') }}"><i class="fas fa-search"></i>Buscar CEP</a>
        <a href="{{ Route('forecast.compare') }}"><i class="fas fa-exchange-alt"></i>Comparar Previsão</a>

        <h1>Histórico</h1>
        <table>
            <tbody>
                @foreach ($forecast as $forecasts)
                <tr>
                    <td data-label="CEP">{{ $forecasts->cep }}</td>
                    <td data-label="Localidade">{{ $forecasts->localidade }}</td>
                    <td data-label="Temperatura">{{ $forecasts->temperatura }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
