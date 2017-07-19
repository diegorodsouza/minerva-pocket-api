@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('StoreAcademico') }}" method="post">

    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Nome do Local de Serviço Acadêmico</label>
        <input type="text" name="nome" placeholder="Digite o nome do local de serviço acadêmico" class="form-control">

        <label for="tipo">Tipo de Serviço Acadêmico</label><br>
        @foreach ($tiposdeacademicos as $tipo)
        <input type="radio" name="tipo" value='{{$tipo->id}}'> {{$tipo->descricao}}<br>
        @endforeach

        <label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" placeholder="Digite o link da imagem do local" class="form-control">

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento do local" class="form-control">
        </textarea>

        <label for="contato">Formas de Contato</label>
        <textarea name="contato" placeholder="Possíveis formas de contato" class="form-control">
        </textarea>

        <label for="observacao">Observações</label>
        <textarea name="observacao" placeholder="Possíveis observações..." class="form-control">
        </textarea>

        <label for="latitude">Localização - Latitude</label>
        <input type="text" name="latitude" placeholder="Digite a latitude do local" class="form-control">

        <label for="longitude">Localização - Longitude</label>
        <input type="text" name="longitude" placeholder="Digite a longitude do local" class="form-control">

        <label for="centro">Localização - Centro</label><br>
        @foreach ($centros as $centro)
          <input type="radio" name="centro" value='{{$centro->id}}'> {{$centro->descricao}}<br>
        @endforeach

      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
