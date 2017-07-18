@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('StoreAlimentacao') }}" method="post">

    {{csrf_field()}}

    <div class="col-lg-3">
      <div class="form-group">
        <label for="nome">Local de Alimentacao</label>
        <input type="text" name="nome" placeholder="Digite o nome do local de alimentacao" class="form-control">

        <label for="preco">Preço Médio do Prato/Kilo</label>
        <input type="text" name="preco" placeholder="Digite o preço médio do prato" class="form-control">

        <label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" placeholder="Digite o link da imagem do local" class="form-control">

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento do local" class="form-control">
        </textarea>

        <label for="latitude">Localização - Latitude</label>
        <input type="text" name="latitude" placeholder="Digite a latitude do local" class="form-control">

        <label for="longitude">Localização - Longitude</label>
        <input type="text" name="longitude" placeholder="Digite a longitude do local" class="form-control">

        <label for="centro">Localização - Centro</label><br>
        <input type="radio" name="centro" value="1"> CCMN<br>
        <input type="radio" name="centro" value="2"> Letras<br>
        <input type="radio" name="centro" value="3"> CT<br>

      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
