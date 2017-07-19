@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('UpdateAcademico', $academico->id) }}" method="post">

    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Nome do Local de Serviço Acadêmico</label>
        <input type="text" name="nome" placeholder="Digite o nome do local de serviço acadêmico" class="form-control"
               value='{{$academico->nome}}'>

        <label for="tipo">Tipo de Serviço Acadêmico</label><br>
        @foreach ($tiposdeacademicos as $tipo)
        <input type="radio" name="tipo" value='{{$tipo->id}}'<?php if($academico->tipo == $tipo->id) echo 'checked' ?>
        > {{$tipo->descricao}}<br>
        @endforeach

        <label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" placeholder="Digite o link da imagem do local" class="form-control"
               value='{{$academico->imagem}}'>

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento do local" class="form-control"
        >{{$academico->funcionamento}}
        </textarea>

        <label for="contato">Formas de Contato</label>
        <textarea name="contato" placeholder="Possíveis formas de contato" class="form-control"
        >{{$academico->contato}}
        </textarea>

        <label for="observacao">Observações</label>
        <textarea name="observacao" placeholder="Possíveis observações..." class="form-control"
        >{{$academico->funcionamento}}
        </textarea>

        <label for="latitude">Localização - Latitude</label>
        <input type="text" name="latitude" placeholder="Digite a latitude do local" class="form-control"
               value='{{$localizacao->latitude}}'>

        <label for="longitude">Localização - Longitude</label>
        <input type="text" name="longitude" placeholder="Digite a longitude do local" class="form-control"
               value='{{$localizacao->longitude}}'>

        <label for="centro">Localização - Centro</label><br>
        @foreach ($centros as $centro)
          <input type="radio" name="centro" value='{{$centro->id}}'<?php if($localizacao->centro_ponto_id == $centro->id) echo 'checked' ?>
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
