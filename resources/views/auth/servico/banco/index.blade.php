@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Caixas e Agências Bancárias</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateServicoBanco') }}">Adicionar Caixa ou Agência Bancária</a>
    </p>
  </div>

  <div class="container _content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Bandeira</th>
          <th>Tipo</th>
          <th>Localização</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($bancos as $banco)
        <tr>
          <td>{{str_limit($banco->id,30)}}</td>
          <td>{{str_limit(App\ServicoBanco::getBancoNome($banco->id),30)}}</td>
          <td>{{str_limit($banco->bandeira,30)}}</td>
          <td>{{str_limit($banco->tipo,30)}}</td>
          <td>{{str_limit(App\ServicoBanco::getBancoLocalizacao($banco->id),30)}}</td>
          <td>
            <form action="{{ route('DestroyServicoBanco', $banco->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditServicoBanco', $banco->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
