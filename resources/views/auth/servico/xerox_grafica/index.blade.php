@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Serviços de Xerox e Gráficas</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateServicoXeroxGrafica') }}">Adicionar Serviço de Xerox ou Gráfica</a>
    </p>
  </div>

  <div class="container _content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Serviço</th>
          <th>Localização</th>
          <th>Observação</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($xerox_graficas as $xerox_grafica)
        <tr>
          <td>{{str_limit($xerox_grafica->id,30)}}</td>
          <td>{{str_limit(App\ServicoXeroxGrafica::getXeroxGraficaNome($xerox_grafica->id),30)}}</td>
          <td>{{str_limit($xerox_grafica->servico,30)}}</td>
          <td>{{str_limit(App\ServicoXeroxGrafica::getXeroxGraficaLocalizacao($xerox_grafica->id),30)}}</td>
          <td>{{str_limit($xerox_grafica->observacao,30)}}</td>
          <td>
            <form action="{{ route('DestroyServicoXeroxGrafica', $xerox_grafica->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditServicoXeroxGrafica', $xerox_grafica->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
