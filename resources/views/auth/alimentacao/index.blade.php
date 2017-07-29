@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Alimentação</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateAlimentacao') }}">Adicionar Local de Alimentação</a>
    </p>
  </div>

  <div class="container _content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Preço</th>
          <th>Localização</th>
          <th>Imagem</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($locais as $local)
        <tr>
          <td>{{str_limit($local->id,30)}}</td>
          <td>{{str_limit($local->nome,30)}}</td>
          <td>{{str_limit($local->preco,30)}}</td>
          <td>{{str_limit(App\Alimentacao::getLocalizacao($local->id),30)}}</td>
          <td>{{str_limit($local->imagem,30)}}</td>
          <td>
            <form action="{{ route('DestroyAlimentacao', $local->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditAlimentacao', $local->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
