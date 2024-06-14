<?php

namespace App\Http\Controllers;

use App\Models\Forecast;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index()
    {
        $forecasts = Forecast::all();
        return view('forecast.index', ['forecast' => $forecasts]);
    }

    public function create()
    {
        return view('forecast.create');
    }

    public function store(Request $request)
    {
        $forecast = new Forecast();
        $forecast->cep = $request->cep;
        $forecast->localidade = $request->localidade;
        $forecast->temperatura = $request->temperatura;
        $forecast->save();
        // dd($request->all('_token'));
        return view('forecast.index');
    }

    public function compare()
    {
        $forecasts = Forecast::all();
        return view('forecast.compare', ['forecast' => $forecasts]);
    }
}
