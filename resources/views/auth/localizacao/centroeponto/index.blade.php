@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Centros e Pontos de Ônibus</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateCentroPonto') }}">Adicionar Centro ou Ponto de Ônibus</a>
    </p>
  </div>

  <div class="container _content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Descrição</th>
          <th>Coordenadas</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($centrosepontos as $centroeponto)
        <tr>
          <td>{{$centroeponto->id}}</td>
          <td>{{$centroeponto->descricao}}</td>
          <td></td>
          <td>
            <form action="{{ route('DestroyCentroPonto', $centroeponto->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditCentroPonto', $centroeponto->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
