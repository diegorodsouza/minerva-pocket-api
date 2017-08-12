@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('UpdateServicoBanco', $banco->id) }}" method="post">

    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Nome de Identificação do Banco</label>
        <input type="text" required name="nome" placeholder="Digite o nome que identificará o banco" class="form-control"
               value='{{$servico->nome}}'>

        <br><label for="tipo">Tipo do Banco</label><br>
        <input type="radio" required name="tipo" value="Agência" <?php if($banco->tipo == "Agência") echo 'checked' ?>> Agência<br>
        <input type="radio" required name="tipo" value="Caixa Eletrônico" <?php if($banco->tipo == "Caixa Eletrônico") echo 'checked' ?>> Caixa Eletrônico<br>

        <br><label for="bandeira">Bandeira do Banco</label><br>
        <input type="radio" required name="bandeira" value="24 Horas" <?php if($banco->bandeira == "24 Horas") echo 'checked' ?>> 24 Horas<br>
        <input type="radio" required name="bandeira" value="Banco do Brasil" <?php if($banco->bandeira == "Banco do Brasil") echo 'checked' ?>> Banco do Brasil<br>
        <input type="radio" required name="bandeira" value="Bradesco" <?php if($banco->bandeira == "Bradesco") echo 'checked' ?>> Bradesco<br>
        <input type="radio" required name="bandeira" value="Caixa" <?php if($banco->bandeira == "Caixa") echo 'checked' ?>> Caixa<br>
        <input type="radio" required name="bandeira" value="Itaú" <?php if($banco->bandeira == "Itaú") echo 'checked' ?>> Itaú<br>
        <input type="radio" required name="bandeira" value="Santander" <?php if($banco->bandeira == "Santander") echo 'checked' ?>> Santander<br>

        <br><label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" placeholder="Digite o link da imagem do local" class="form-control" value='{{$servico->imagem}}'>
        <small id="imagemHelp" class="form-text text-muted">A url deve ser publicada no <a href="https://imgur.com/upload" target="_blank">Imgur</a> antes.</small>

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento do local" class="form-control">{{$servico->funcionamento}}
        </textarea>

        <hr>

        <label for="latitude">Localização - Latitude</label>
        <input type="text" required name="latitude" placeholder="Digite a latitude do local" class="form-control" value='{{$localizacao->latitude}}'>

        <label for="longitude">Localização - Longitude</label>
        <input type="text" required name="longitude" placeholder="Digite a longitude do local" class="form-control" value='{{$localizacao->longitude}}'>

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
