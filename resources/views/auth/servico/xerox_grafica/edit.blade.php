@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('UpdateServicoXeroxGrafica', $xerox_grafica->id) }}" method="post">

    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Nome de Identificação do Serviço</label>
        <input type="text" name="nome" placeholder="Digite o nome que identificará o serviço" class="form-control" value="{{$servico->nome}}">

        <label for="servico">Tipo do Serviço</label><br>
        <input type="radio" name="servico" value="Gráfica"> Gráfica<br>
        <input type="radio" name="servico" value="Xerox"> Xerox<br>


        <label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" placeholder="Digite o link da imagem do local" class="form-control" value="{{$servico->imagem}}">

        <label for="observacao">Observação</label>
        <textarea name="observacao" placeholder="Escreva algo mais sobre a forma como esse servico é prestado, como os serviços disponíveis ou o preço" class="form-control">{{$xerox_grafica->observacao}}
        </textarea>

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento do local" class="form-control">{{$servico->funcionamento}}
        </textarea>

        <label for="latitude">Localização - Latitude</label>
        <input type="text" name="latitude" placeholder="Digite a latitude do local" class="form-control" value="{{$localizacao->latitude}}">

        <label for="longitude">Localização - Longitude</label>
        <input type="text" name="longitude" placeholder="Digite a longitude do local" class="form-control" value="{{$localizacao->longitude}}">

        <label for="centro">Localização - Centro</label><br>
        @foreach ($centros as $centro)
          <input type="radio" name="centro" value='{{$centro->id}}' <?php if($localizacao->centro_ponto_id == $centro->id) echo 'checked' ?>> {{$centro->descricao}}<br>
        @endforeach


      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
