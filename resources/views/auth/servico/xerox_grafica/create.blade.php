@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('StoreServicoXeroxGrafica') }}" method="post">

    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Nome de Identificação do Serviço</label>
        <input type="text" required name="nome" placeholder="Digite o nome que identificará o serviço" class="form-control">

        <label for="servico">Tipo do Serviço</label><br>
        <input type="radio" required name="servico" value="Gráfica"> Gráfica<br>
        <input type="radio" required name="servico" value="Xerox" checked> Xerox<br>


        <label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" pattern="https{0,1}://i.imgur.com/.*|https{0,1}://imgur.com/.*" placeholder="http://imgur.com/..." class="form-control">
        <small id="imagemHelp" class="form-text text-muted">
          A url deve ser publicada no <a href="https://imgur.com/upload" target="_blank">Imgur</a> antes.<br>
          Após, deve-se clicar em Copy para copiar o link da imagem fornecido pelo imgur, que deve ter este formato: http://imgur.com/...<br>
        </small><br>

        <label for="observacao">Observação</label>
        <textarea name="observacao" placeholder="Escreva algo mais sobre a forma como esse servico é prestado, como os serviços disponíveis ou o preço" class="form-control">
        </textarea>

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento do local" class="form-control">
        </textarea>

        <hr>

        <label for="gmaps">Localização - AutoPreencher por Link do <a href="https://www.google.com.br/maps/" target="_blank">Google Maps</a></label>
        <div class="input-group">
        <input type="text" required name="gmaps" id="gmaps" placeholder="Cole o link do Google Maps do navegador" class="form-control">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="button" onclick="pegaCoord()">Preencher</button>
        </span>
        </div>

        <br>  
        
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
