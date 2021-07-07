<?php

namespace Tests\Unit;

use App\Models\Serie;
use App\Services\SerieService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;



class SeriesTest extends TestCase
{
    use RefreshDatabase;

    private $serie;

    protected function setUp(): void
    {
        parent::setUp();
        $criadorDeSerie = new SerieService();
        $nomeSerie = 'Nome de teste';
        $this->serie = $criadorDeSerie->criarSerie($nomeSerie, 1, 1);
    }

    public function testCriarSerie()
    {
        $criadorDeSerie = new SerieService();
        $nomeSerie = 'Nome de teste';
        $serieCriada = $criadorDeSerie->criarSerie($nomeSerie, 1, 1);

        $this->assertInstanceOf(Serie::class, $serieCriada);
        $this->assertDatabaseHas('series', ['nome' => $nomeSerie]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serieCriada->id, 'numero' => 1]);
        $this->assertDatabaseHas('episodios', ['numero' => 1]);
    }

    public function testExcluirSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);

        $removedorDeSerie = new SerieService();
        $nomeSerie = $removedorDeSerie->removerSerie($this->serie->id);

        $this->assertIsString($nomeSerie);
        $this->assertEquals('Nome de teste', $nomeSerie);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
