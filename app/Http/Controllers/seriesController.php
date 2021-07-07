<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episodio;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Temporada;
use App\Services\SerieService;

class seriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        // if (!Auth::check()) {
        //     echo "Não autenticado";
        //     exit();
        // }

        $series = Serie::query()
            ->orderBy('nome')
            ->get();

        $mensagem = $request->session()->get('mensagem');
        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, SerieService $SerieService)
    {
        $serie = $SerieService->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );

        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->id} - {$serie->nome}, temporadas e episórios cadastrados com sucesso!"
            );

        return redirect('/series');
    }

    public function editaNome($id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }

    public function destroy(Request $request, SerieService $SerieService)
    {
        //Excluir em cascata
        $nomeSerie = $SerieService->removerSerie($request->id);

        $request->session()
            ->flash(
                'mensagem',
                "Série $nomeSerie excluída com sucesso!"
            );
        return redirect('/series');
    }
}
