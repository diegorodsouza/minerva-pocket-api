@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Acadêmico</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateAcademico') }}">Adicionar Serviço Acadêmico</a>
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
          <th>Contato</th>
          <th>Imagem</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($academicos as $academico)
        <tr>
          <td>{{str_limit($academico->id,30)}}</td>
          <td>{{str_limit($academico->nome,30)}}</td>
          <td>{{str_limit(App\Academico::getTipo($academico->id),30)}}</td>
          <td>{{str_limit($academico->contato,30)}}</td>
          <td>{{str_limit(App\Academico::getLocalizacao($academico->id),30)}}</td>
          <td>{{str_limit($academico->imagem,30)}}</td>
          <td>
            <form action="{{ route('DestroyAcademico', $academico->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditAcademico', $academico->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
