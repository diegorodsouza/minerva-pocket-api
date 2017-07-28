@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Serviços Diversos</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateServicoOutro') }}">Adicionar Serviços Diversos</a>
    </p>
  </div>

  <div class="container _content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Servico</th>
          <th>Localização</th>
          <th>Observação</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($outros as $outro)
        <tr>
          <td>{{str_limit($outro->id,30)}}</td>
          <td>{{str_limit(App\ServicoOutro::getOutroNome($outro->id),30)}}</td>
          <td>{{str_limit($outro->servico,30)}}</td>
          <td>{{str_limit(App\ServicoOutro::getOutroLocalizacao($outro->id),30)}}</td>
          <td>{{str_limit($outro->observacao,30)}}</td>
          <td>
            <form action="{{ route('DestroyServicoOutro', $outro->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditServicoOutro', $outro->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection