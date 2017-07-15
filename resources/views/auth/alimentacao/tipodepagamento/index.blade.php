@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Formas de Pagamento</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateTipoDePagamento') }}">Adicionar Forma de Pagamento</a>
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
        @foreach ($tiposdepagamentos as $pagamento)
        <tr>
          <td>{{$pagamento->id}}</td>
          <td>{{$pagamento->descricao}}</td>
          <td>
            <!-- <a href="{{ url('/', $pagamento->id) }}" class="btn btn-danger">Excluir</a> -->
            <a href="{{ route('EditTipoDePagamento', $pagamento->id) }}" class="btn btn-primary">Editar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
