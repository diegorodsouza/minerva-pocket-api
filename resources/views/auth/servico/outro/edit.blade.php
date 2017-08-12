@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('UpdateServicoOutro', $outro->id) }}" method="post">

    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Nome de Identificação desse Serviço</label>
        <input type="text" required name="nome" placeholder="Digite o nome que identificará o servico" class="form-control" value="{{$servico->nome}}">

        <label for="servico">Tipo de Serviço</label>
        <input type="text" required name="servico" placeholder="Digite qual o serviço prestado" class="form-control" value="{{$outro->servico}}">

        <label for="descricao">Descrição</label>
        <textarea name="descricao" placeholder="Escreva mais sobre o estabelecimento ou tipo de servico prestado..." class="form-control">{{$outro->descricao}}
        </textarea>

        <label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" placeholder="Digite o link da imagem do local" class="form-control" value="{{$servico->imagem}}">
        <small id="imagemHelp" class="form-text text-muted">A url deve ser publicada no <a href="https://imgur.com/upload" target="_blank">Imgur</a> antes.</small>

        <label for="observacao">Observação</label>
        <textarea name="observacao" placeholder="Escreva uma observação sobre o serviço se necessário..." class="form-control">{{$outro->observacao}}
        </textarea>

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento do local" class="form-control">{{$outro->funcionamento}}
        </textarea>

        <hr>

        <label for="latitude">Localização - Latitude</label>
        <input type="text" required name="latitude" placeholder="Digite a latitude do local" class="form-control" value="{{$localizacao->latitude}}">

        <label for="longitude">Localização - Longitude</label>
        <input type="text" required name="longitude" placeholder="Digite a longitude do local" class="form-control" value="{{$localizacao->longitude}}">

        <label for="centro">Localização - Centro</label><br>
        @foreach ($centros as $centro)
          <input type="radio" required name="centro" value='{{$centro->id}}' <?php if($localizacao->centro_ponto_id == $centro->id) echo 'checked' ?>> {{$centro->descricao}}<br>
        @endforeach


      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
