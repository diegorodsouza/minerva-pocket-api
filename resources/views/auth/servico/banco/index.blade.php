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
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                Excluir
              </button>

              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Deseja realmente excluir?</h4>
                    </div>
                    <div class="modal-body">
                      Confirme que deseja excluir {{App\ServicoBanco::getBancoNome($banco->id)}}.
                      <p class="aviso">
                        Essa ação não poderá ser desfeita.
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                      <input type="submit" value="Excluir" class="btn btn-danger">
                    </div>
                  </div>
                </div>
              </div>



              <a href="{{ route('EditServicoBanco', $banco->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
