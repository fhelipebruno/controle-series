@extends('template')

@section('cabecalho')
Episodios
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<form action="/temporadas/{{$temporadaId}}/episodios/assistir" method="POST">
  @csrf
  <ul class="list-group">

    @foreach ($episodios as $episodio)
    <li class="list-group-item d-flex justify-content-between align-itens-center">
      Episódio {{$episodio->numero}}
      <input type="checkbox" name="episodios[]" id="episodios" value="{{$episodio->id}}" {{$episodio->assistido ? 'checked' : ''}}>
    </li>
    @endforeach
  </ul>
  <button class="btn-primary mt-2 mb-2">Salvar</button>
</form>
@endsection