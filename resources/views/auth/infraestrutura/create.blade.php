@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('StoreInfraestrutura') }}" method="post">

    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Nome do Local</label>
        <input type="text" required name="nome" placeholder="Digite o nome da local/tipo da infraestrurura" class="form-control">

        <br><label for="tipo">Tipo de Infraestrutura</label><br>
        <input type="radio" required name="tipo" value='Banheiro' checked> Banheiro<br>
        <input type="radio" required name="tipo" value='Bebedouro' checked> Bebedouro<br>
        <input type="radio" required name="tipo" value='Bicicletario' checked> Bicicletario<br>
        <input type="radio" required name="tipo" value='Estacionamento' checked> Estacionamento<br>

        <label for="detalhes">Detalhes</label>
        <textarea name="detalhes" placeholder="Descreva as principais características do local" class="form-control">
        </textarea>

        <br><label for="situacao">Situação do Local</label><br>
        <input type="radio" required name="situacao" value=3 checked> Ótimo<br>
        <input type="radio" required name="situacao" value=2 checked> Utilizável<br>
        <input type="radio" required name="situacao" value=1 checked> Inutilizável<br>

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
