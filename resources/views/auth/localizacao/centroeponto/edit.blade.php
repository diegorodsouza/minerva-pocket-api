@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('UpdateCentroPonto', $localizacao->id) }}" method="post">

    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="descricao">Nome do Centro ou Ponto de Ônibus</label>
        <input type="text" required name="descricao" placeholder="Digite o nome do centro ou ponto de ônibus" class="form-control"
               value="{{$centroeponto->descricao }}">

       <label for="tipo">Tipo</label><br>
       <input type="radio" required name="tipo" value='Centro' <?php if($centroeponto->tipo == 'Centro') echo 'checked' ?> > Centro<br>
       <input type="radio" required name="tipo" value='Ponto' <?php if($centroeponto->tipo == 'Ponto') echo 'checked' ?> > Ponto de Ônibus<br>

       <hr>

       
       <label for="gmaps">Localização - AutoPreencher por Link do Google Maps</label>
        <div class="input-group">
        <input type="text" required name="gmaps" id="gmaps" placeholder="Cole o link do Google Maps do navegador" class="form-control">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="button" onclick="pegaCoord()">Preencher</button>
        </span>
        </div>

        <br>  

       <label for="latitude">Localização - Latitude</label>
       <input type="text" required name="latitude" placeholder="Digite a latitude do local" class="form-control"
              value='{{$localizacao->latitude}}'>

       <label for="longitude">Localização - Longitude</label>
       <input type="text" required name="longitude" placeholder="Digite a longitude do local" class="form-control"
              value='{{$localizacao->longitude}}'>
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
  var str = str.split("").reverse().join("");
  
  var res1 = str.split("d4!");
  var res10 = res1[0].split("").reverse().join("");
  var res01 = res10.split("?");
  var longitude = res01[0];
  
  var res2 = res1[1].split("d3!");
  var res20 = res2[0].split("").reverse().join("");
  var res02 = res20.split("?");
  var latitude = res02[0];
  
  document.getElementById("latitude").value = latitude;
  document.getElementById("longitude").value = longitude;
}
</script>
@endsection
