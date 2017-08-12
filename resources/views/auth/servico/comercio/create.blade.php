@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('StoreServicoComercio') }}" method="post">

    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="nome">Nome de do Comércio</label>
        <input type="text" required name="nome" placeholder="Digite o nome que identificará o comércio" class="form-control">

        <label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" pattern="https{0,1}://i.imgur.com/.*|https{0,1}://imgur.com/.*" placeholder="http://imgur.com/..." class="form-control">
        <small id="imagemHelp" class="form-text text-muted">
          A url deve ser publicada no <a href="https://imgur.com/upload" target="_blank">Imgur</a> antes.<br>
          Após, deve-se clicar em Copy para copiar o link da imagem fornecido pelo imgur, que deve ter este formato: http://imgur.com/...<br>
        </small><br>

        <label for="especialidade">Especialidade do Comércio</label>
        <input type="text" required name="especialidade" placeholder="Digite que tipo de comércio o estabelecimento é" class="form-control">

        <label for="descricao">Descrição</label>
        <textarea name="descricao" placeholder="Escreva mais sobre o estabelecimento..." class="form-control">
        </textarea>

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento do local" class="form-control">
        </textarea>

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
