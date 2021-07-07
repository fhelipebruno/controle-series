<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{
    public function index(int $serieId, Request $request)
    {
        $serie = Serie::find($serieId);
        $temporadas = $serie->temporadas;
        $mensagem = $request->session()->get('mensagem');

        return view('temporadas.index', compact('temporadas', 'serie', 'mensagem'));
    }
}
