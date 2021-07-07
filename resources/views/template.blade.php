<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/4860a524eb.js" crossorigin="anonymous"></script>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <title>Adicionar Série</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('listar_series') }}">Home</a>
      @auth
      <a href="/sair" class="text-danger">Sair</a>
      @endauth

      @guest
      <a href="/entrar">Entrar</a>
      @endguest
    </div>
  </nav>

  <div class="container">
    <div class="jumbotron">
      <h1>@yield('cabecalho')</h1>
    </div>
    @yield('conteudo')
  </div>
</body>

</html>