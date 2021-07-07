<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mr-2">
    <a class="navbar navbar-expand-lg" href="{{ route('listar_series') }}">Home</a>
  </nav>
  <div class="container">
    <div class="jumbotron">
      <h1>@yield('cabecalho')</h1>
    </div>

    @yield('conteudo')
  </div>
</body>

</html>