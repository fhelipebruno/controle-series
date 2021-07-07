<?php

namespace App\Services;

//importa vários namespaces em uma mesma linha
use App\Models\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class SerieService
{
  public function criarSerie(string $nome, int $qtdTemporadas, int $epPorTemporada): Serie
  {
    DB::beginTransaction();
    $serie = Serie::create(['nome' => $nome]);

    $this->criaTemporadas($qtdTemporadas, $epPorTemporada, $serie);

    DB::commit();

    return $serie;
  }

  public function criaTemporadas(int $qtdTemporadas, int $epPorTemporada, Serie $serie)
  {
    for ($i = 1; $i <= $qtdTemporadas; $i++) {
      $temporada = $serie->temporadas()->create(['numero' => $i]);

      $this->criaEpisodios($epPorTemporada, $temporada);
    }
  }

  public function criaEpisodios(int $epPorTemporada, Temporada $temporada)
  {
    for ($j = 1; $j <= $epPorTemporada; $j++) {
      $temporada->episodios()->create(['numero' => $j]);
    }
  }

  public function removerSerie(int $serieId): string
  {
    $nomeSerie = '';
    //Utilizando transação
    DB::transaction(function () use ($serieId, &$nomeSerie) {
      $serie = Serie::find($serieId);
      $nomeSerie = $serie->nome;
      $this->removerTemporadas($serie);
      $serie->delete();
    });

    return $nomeSerie;
  }

  private function removerTemporadas(Serie $serie): void
  {
    $serie->temporadas->each(function (Temporada $temporada) {
      $this->removerEpisodios($temporada);
      $temporada->delete();
    });
  }

  private function removerEpisodios(Temporada $temporada): void
  {
    $temporada->episodios->each(function (Episodio $episodio) {
      $episodio->delete();
    });
  }
}
