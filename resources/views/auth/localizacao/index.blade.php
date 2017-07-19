@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Linhas de Ônibus</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateTransporte') }}">Adicionar Linha de Ônibus</a>
    </p>
  </div>

  <div class="container _content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Linha</th>
          <th>Tipo</th>
          <th>Preço</th>
          <th>Imagem</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($transportes as $transporte)
        <tr>
          <td>{{$transporte->id}}</td>
          <td>{{$transporte->linha}}</td>
          <td>{{$transporte->tipo}}</td>
          <td>{{$transporte->preco}}</td>
          <td>{{$transporte->imagem}}</td>
          <td>
            <form action="{{ route('DestroyTransporte', $transporte->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Excluir" class="btn btn-danger">

              <a href="{{ route('EditTransporte', $transporte->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
