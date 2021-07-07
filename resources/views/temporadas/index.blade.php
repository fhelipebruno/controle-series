@extends('template')

@section('cabecalho')
Temporadas de {{$serie->nome}}
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<ul class="list-group">
  @foreach ($temporadas as $temporada)
  <li class="list-group-item d-flex justify-content-between align-itens-center">
    <a href="/temporadas/{{$temporada->id}}/episodios">Temporada {{$temporada->numero }}</a>
    <span class="badge bg-secondary">{{$temporada->getEpisodiosAssistidos()->count()}} / {{$temporada->episodios->count()}}</span>
  </li>
  @endforeach
</ul>
@endsection