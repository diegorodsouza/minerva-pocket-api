@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('UpdateInfraestrutura', $infra->id) }}" method="post">

    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Nome do Local</label>
        <input type="text" required name="nome" placeholder="Digite o nome da local/tipo da infraestrurura" class="form-control"
               value='{{$infra->nome}}'>

        <br><label for="tipo">Tipo de Infraestrutura</label><br>
        <input type="radio" required name="tipo" value='Banheiro' <?php if($infra->tipo == "Banheiro") echo 'checked' ?>> Banheiro<br>
        <input type="radio" required name="tipo" value='Bebedouro' <?php if($infra->tipo == "Bebedouro") echo 'checked' ?>> Bebedouro<br>
        <input type="radio" required name="tipo" value='Bicicletario' <?php if($infra->tipo == "Bicicletario") echo 'checked' ?>> Bicicletario<br>
        <input type="radio" required name="tipo" value='Estacionamento' <?php if($infra->tipo == "Estacionamento") echo 'checked' ?>> Estacionamento<br>

        <label for="detalhes">Detalhes</label>
        <textarea name="detalhes" placeholder="Descreva as principais características do local" class="form-control"
        >{{$infra->detalhes}}
        </textarea>

        <br><label for="situacao">Situação do Local</label><br>
        <input type="radio" required name="situacao" value=3 <?php if($infra->situacao == 3) echo 'checked' ?>> Ótimo<br>
        <input type="radio" required name="situacao" value=2 <?php if($infra->situacao == 2) echo 'checked' ?>> Utilizável<br>
        <input type="radio" required name="situacao" value=1 <?php if($infra->situacao == 1) echo 'checked' ?>> Inutilizável<br>

        <hr>

        <label for="latitude">Localização - Latitude</label>
        <input type="text" required name="latitude" placeholder="Digite a latitude do local" class="form-control"
               value='{{$localizacao->latitude}}'>

        <label for="longitude">Localização - Longitude</label>
        <input type="text" required name="longitude" placeholder="Digite a longitude do local" class="form-control"
               value='{{$localizacao->longitude}}'>

        <label for="centro">Localização - Centro</label><br>
        @foreach ($centros as $centro)
          <input type="radio" required name="centro" value='{{$centro->id}}'<?php if($localizacao->centro_ponto_id == $centro->id) echo 'checked' ?>
          > {{$centro->descricao}}<br>
        @endforeach

      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
