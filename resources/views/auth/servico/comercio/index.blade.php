@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Serviços de Comércio</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateServicoComercio') }}">Adicionar Serviço de Comércio</a>
    </p>
  </div>

  <div class="container _content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Especialidade</th>
          <th>Localização</th>
          <th>Descrição</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($comercios as $comercio)
        <tr>
          <td>{{str_limit($comercio->id,30)}}</td>
          <td>{{str_limit(App\ServicoComercio::getComercioNome($comercio->id),30)}}</td>
          <td>{{str_limit($comercio->especialidade, 30)}}</td>
          <td>{{str_limit(App\ServicoComercio::getComercioLocalizacao($comercio->id),30)}}</td>
          <td>{{str_limit($comercio->descricao, 30)}}</td>
          <td>
            <form action="{{ route('DestroyServicoComercio', $comercio->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditServicoComercio', $comercio->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
