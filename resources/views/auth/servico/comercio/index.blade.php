@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>Serviços de Comércio</h1>
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <p>
      <a class="btn btn-success" href="{{ route('CreateServicoComercio') }}">Adicionar Serviço de Comércio</a>
    </p>
  </div>

  <div class="container _content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Especialidade</th>
          <th>Localização</th>
          <th>Descrição</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($comercios as $comercio)
        <tr>
          <td>{{str_limit($comercio->id,30)}}</td>
          <td>{{str_limit(App\ServicoComercio::getComercioNome($comercio->id),30)}}</td>
          <td>{{str_limit($comercio->especialidade, 30)}}</td>
          <td>{{str_limit(App\ServicoComercio::getComercioLocalizacao($comercio->id),30)}}</td>
          <td>{{str_limit($comercio->descricao, 30)}}</td>
          <td>
            <form action="{{ route('DestroyServicoComercio', $comercio->id) }}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{$comercio->id}}">
                Excluir
              </button>

              <div class="modal fade" id="myModal-{{$comercio->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Deseja realmente excluir?</h4>
                    </div>
                    <div class="modal-body">
                      Confirme que deseja excluir {{App\ServicoComercio::getComercioNome($comercio->id)}}.
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

              <a href="{{ route('EditServicoComercio', $comercio->id) }}" class="btn btn-primary">Editar</a>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
