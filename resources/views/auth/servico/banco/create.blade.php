@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('StoreServicoBanco') }}" method="post">

    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Nome de Identificação do Banco</label>
        <input type="text" required name="nome" placeholder="Digite o nome que identificará o banco" class="form-control">

        <br><label for="tipo">Tipo do Banco</label><br>
        <input type="radio" required name="tipo" value="Agência"> Agência<br>
        <input type="radio" required name="tipo" value="Caixa Eletrônico" checked> Caixa Eletrônico<br>

        <br><label for="bandeira">Bandeira do Banco</label><br>
        <input type="radio" required name="bandeira" value="24 Horas" checked> 24 Horas<br>
        <input type="radio" required name="bandeira" value="Banco do Brasil"> Banco do Brasil<br>
        <input type="radio" required name="bandeira" value="Bradesco"> Bradesco<br>
        <input type="radio" required name="bandeira" value="Caixa"> Caixa<br>
        <input type="radio" required name="bandeira" value="Itaú"> Itaú<br>
        <input type="radio" required name="bandeira" value="Santander" checked> Santander<br>

        <br><label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" pattern="https{0,1}://i.imgur.com/.*" placeholder="http://imgur.com/..." class="form-control">
        <small id="imagemHelp" class="form-text text-muted">
          A url deve ser publicada no <a href="https://imgur.com/upload" target="_blank">Imgur</a> antes.<br>
          Após, deve-se copiar o link da imagem, que deve ser do formato https://i.imgur.com/... e terminar com a extensão do arquivo.<br>
        </small><br>

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento do local" class="form-control">
        </textarea>

        <hr>

        <label for="latitude">Localização - Latitude</label>
        <input type="text" required name="latitude" placeholder="Digite a latitude do local" class="form-control">

        <label for="longitude">Localização - Longitude</label>
        <input type="text" required name="longitude" placeholder="Digite a longitude do local" class="form-control">

        <label for="centro">Localização - Centro</label><br>
        @foreach ($centros as $centro)
          <input type="radio" required name="centro" value='{{$centro->id}}' checked> {{$centro->descricao}}<br>
        @endforeach


      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
