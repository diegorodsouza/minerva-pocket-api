@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('StoreTransporte') }}" method="post">

    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="linha">Linha de Ônibus</label>
        <input type="text" required name="linha" placeholder="Digite o nome da linha de ônibus" class="form-control">

        <label for="tipo">Tipo da Linha de Ônibus</label><br>
        <input type="radio" required name="tipo" value="Interno"> Interno<br>
        <input type="radio" required name="tipo" value="Externo" checked> Externo<br>

        <label for="preco">Preço da Passagem</label>
        <input type="text" name="preco" placeholder="Digite o preço padrão da passagem" class="form-control">

        <label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" pattern="https{0,1}://i.imgur.com/.*|https{0,1}://imgur.com/.*" placeholder="http://imgur.com/..." class="form-control">
        <small id="imagemHelp" class="form-text text-muted">
          A url deve ser publicada no <a href="https://imgur.com/upload" target="_blank">Imgur</a> antes.<br>
          Após, deve-se clicar em Copy para copiar o link da imagem fornecido pelo imgur, que deve ter este formato: http://imgur.com/...<br>
        </small><br>

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento da linha de ônibus" class="form-control">
        </textarea>

        <label for="observacao">Observações</label>
        <textarea name="observacao" placeholder="Possíveis observações sobre essa linha..." class="form-control">
        </textarea>

        <label for="ponto">Pontos em que essa Linha de ônibus passa</label><br>
        @foreach ($pontos as $ponto)
          <input type="checkbox" name="ponto[]" value='{{$ponto->id}}'> {{$ponto->descricao}}<br>
        @endforeach

      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
