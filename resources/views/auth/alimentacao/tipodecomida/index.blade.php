Comida@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Tipo de Comida</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateTipoDeComida') }}">Adicionar Tipo de Serviço de Comida</a>
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
        @foreach ($tiposdecomidas as $comida)
        <tr>
          <td>{{$comida->id}}</td>
          <td>{{$comida->descricao}}</td>
          <td>
            <form action="{{ route('DestroyTipoDeComida', $comida->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditTipoDeComida', $comida->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
