@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Tipo de Serviço Acadêmico</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateTipoDeAcademico') }}">Adicionar Tipo de Serviço Acadêmico</a>
    </p>
  </div>

  <div class="container _content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Descrição</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tiposdeacademicos as $academico)
        <tr>
          <td>{{$academico->id}}</td>
          <td>{{$academico->descricao}}</td>
          <td>
            <form action="{{ route('DestroyTipoDeAcademico', $academico->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditTipoDeAcademico', $academico->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
