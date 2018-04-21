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
        <input type="text" required name="nome" placeholder="Digite o nome do local de serviço acadêmico" class="form-control"
               value='{{$academico->nome}}'>

        <br><label for="tipo">Tipo de Serviço Acadêmico</label><br>
        @foreach ($tiposdeacademicos as $tipo)
        <input type="radio" required name="tipo" value='{{$tipo->id}}'<?php if($academico->tipo == $tipo->id) echo 'checked' ?>
        > {{$tipo->descricao}}<br>
        @endforeach

        <br><label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" pattern="https{0,1}://i.imgur.com/.*|https{0,1}://imgur.com/.*" placeholder="http://imgur.com/..." class="form-control"
               value='{{$academico->imagem}}' required>
        <small id="imagemHelp" class="form-text text-muted">
          A url deve ser publicada no <a href="https://imgur.com/upload" target="_blank">Imgur</a> antes.<br>
          Após, deve-se passar o mouse sobre a imagem e clicar em Copy para copiar o link da imagem fornecido pelo imgur, que deve ter este formato: http://imgur.com/...<br>
        </small><br>

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
        >{{$academico->observacao}}
        </textarea>

        <hr>

        <label for="gmaps">Localização - AutoPreencher por Link do <a href="https://www.google.com.br/maps/" target="_blank">Google Maps</a></label>
        <div class="input-group">
        <input type="text" name="gmaps" id="gmaps" placeholder="Cole o link do Google Maps do navegador" class="form-control">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="button" onclick="pegaCoord()">Preencher</button>
        </span>
        </div>

        <br>  
        
        <label for="latitude">Localização - Latitude</label>
        <input type="text" required name="latitude" id="latitude" placeholder="Digite a latitude do local" class="form-control"
               value='{{$localizacao->latitude}}'>

        <label for="longitude">Localização - Longitude</label>
        <input type="text" required name="longitude" id="longitude" placeholder="Digite a longitude do local" class="form-control"
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
