@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('StoreCentroPonto') }}" method="post">

    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="descricao">Nome do Centro ou Ponto de Ônibus</label>
        <input type="text" required name="descricao" placeholder="Digite o nome do centro ou ponto de ônibus" class="form-control">

        <label for="tipo">Tipo</label><br>
        <input type="radio" required name="tipo" value='Centro'> Centro<br>
        <input type="radio" required name="tipo" value='Ponto' checked> Ponto de Ônibus<br>

        <hr>

        <div class="input-group">
        <label for="gmaps">Localização - AutoPreencher por Link do Google Maps</label>
        <input type="text" required name="gmaps" id="gmaps" placeholder="Cole o link do Google Maps do navegador" class="form-control">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="button" onclick="pegaCoord()">Pesquisar</button>
        </span>
        </div>

        <br>  

        <label for="latitude">Localização - Latitude</label>
        <input type="text" required name="latitude" id="latitude" placeholder="Digite a latitude do local" class="form-control">

        <label for="longitude">Localização - Longitude</label>
        <input type="text" required name="longitude" id="longitude" placeholder="Digite a longitude do local" class="form-control">

      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>

<script>
function pegaCoord() {
    var str = document.getElementById('gmaps').value;
    var res1 = str.split("@");
    var res2 = res1[1].split(",");
    document.getElementById("latitude").value = res2[0];
    document.getElementById("longitude").value = res2[1];
}
</script>
@endsection
