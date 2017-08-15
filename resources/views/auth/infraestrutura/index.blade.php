@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Infraestrutura</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateInfraestrutura') }}">Adicionar Infraestrutura</a>
    </p>
  </div>

  <div class="container _content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Tipo</th>
          <th>Localização</th>
          <th>Situação</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($infras as $infra)
        <tr>
          <td>{{str_limit($infra->id,30)}}</td>
          <td>{{str_limit($infra->nome,30)}}</td>
          <td>{{str_limit($infra->tipo),30)}}</td>
          <td>{{str_limit($infra->contato,30)}}</td>
          <td>{{str_limit(App\Infraestrutura::getLocalizacao($infra->id),30)}}</td>
          <td>{{str_limit(App\Infraestrutura::getSituacao($infra->situacao),30)}}</td>
          <td>
            <form action="{{ route('DestroyInfraestrutura', $infra->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditInfraestrutura', $infra->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
