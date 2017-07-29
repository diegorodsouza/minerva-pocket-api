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
        <input type="text" name="descricao" placeholder="Digite o nome do centro ou ponto de ônibus" class="form-control"
               value="{{$centroeponto->descricao }}">

       <label for="tipo">Tipo</label><br>
       <input type="radio" name="tipo" value='Centro' <?php if($centroeponto->tipo == 'Centro') echo 'checked' ?> > Centro<br>
       <input type="radio" name="tipo" value='Ponto' <?php if($centroeponto->tipo == 'Ponto') echo 'checked' ?> > Ponto de Ônibus<br>

       <hr>

       <label for="latitude">Localização - Latitude</label>
       <input type="text" name="latitude" placeholder="Digite a latitude do local" class="form-control"
              value='{{$localizacao->latitude}}'>

       <label for="longitude">Localização - Longitude</label>
       <input type="text" name="longitude" placeholder="Digite a longitude do local" class="form-control"
              value='{{$localizacao->longitude}}'>
      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
