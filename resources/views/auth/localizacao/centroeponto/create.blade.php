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

        <label for="latitude">Localização - Latitude</label>
        <input type="text" required name="latitude" placeholder="Digite a latitude do local" class="form-control">

        <label for="longitude">Localização - Longitude</label>
        <input type="text" required name="longitude" placeholder="Digite a longitude do local" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
