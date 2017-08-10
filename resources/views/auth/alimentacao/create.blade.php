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

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Local de Alimentacao</label>
        <input type="text" required name="nome" placeholder="Digite o nome do local de alimentacao" class="form-control">

        <label for="preco">Preços Médios</label>
        <textarea name="preco" class="form-control" placeholder="Digite os preços médio do estabelecimento"></textarea>

        <label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" placeholder="Digite o link da imagem do local" class="form-control">

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

        <hr>

        <label for="tipodepagamento">Formas de Pagamento Aceitas</label><br>
        @foreach ($tiposdepagamentos as $tipodepagamento)
          <input type="checkbox" name="tipodepagamento[]" value='{{$tipodepagamento->id}}'> {{$tipodepagamento->descricao}}<br>
        @endforeach

        <hr>

        <label for="tipodecomida">Tipos de Serviço de Comida Disponíveis</label><br>
        @foreach ($tiposdecomidas as $tipodecomida)
          <input type="checkbox" name="tipodecomida[]" value='{{$tipodecomida->id}}'> {{$tipodecomida->descricao}}<br>
        @endforeach

      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
