@extends('layouts.app')

@section('content')
  <style>
    ._content{
      width: 700px;
      display: flex;
      justify-content: center;
      margin-top: 100px;
    }
  </style>

  <div class="container">
    <h1>Formas de Pagamento</h1>
    @if(session('success'))
      <p class="alert-success">
        {{ session('success') }}
      </p>
    @endif
    <p>
      <a class="btn btn-success" href="{{url('/create_tipodepagamento')}}">Adicionar Forma de Pagamento</a>
    </p>
  </div>
  <div class="_content">
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
            <a href="{{ url('/edit_tipodepagamento', $pagamento->id) }}" class="btn btn-primary">Editar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
