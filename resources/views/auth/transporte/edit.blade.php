@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('UpdateTransporte', $transporte->id) }}" method="post">

    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="linha">Linha de Ônibus</label>
        <input type="text" name="linha" placeholder="Digite o nome da linha de ônibus" class="form-control"
               value='{{$transporte->linha}}'>

        <label for="tipo">Tipo da Linha de Ônibus</label><br>
        <input type="radio" name="tipo" value='Interno'<?php if($transporte->tipo == 'Interno') echo 'checked' ?>> Interno<br>
        <input type="radio" name="tipo" value='Externo'<?php if($transporte->tipo == 'Externo') echo 'checked' ?>> Externo<br>

        <label for="preco">Preço da Passagem</label>
        <input type="text" name="preco" placeholder="Digite o preço padrão da passagem" class="form-control"
               value='{{$transporte->preco}}'>

        <label for="imagem">Link da Imagem</label>
        <input type="text" name="imagem" placeholder="Digite o link da imagem do ônibus" class="form-control"
               value='{{$transporte->imagem}}'>

        <label for="funcionamento">Funcionamento</label>
        <textarea name="funcionamento" placeholder="Descreva os horários de funcionamento da linha de ônibus" class="form-control"
        >{{$transporte->funcionamento}}
        </textarea>

        <label for="observacao">Observações</label>
        <textarea name="observacao" placeholder="Possíveis observações sobre essa linha..." class="form-control"
        >{{$transporte->observacao}}
        </textarea>

        <label for="ponto">Pontos em que essa Linha de ônibus passa</label><br>
        @foreach ($pontos as $ponto)

          <input type="checkbox" name="ponto[]" value='{{$ponto->id}}'
          <?php
            foreach ($transportes_localizacoes as $transporte_localizacao)
              if($ponto->id == $transporte_localizacao->ponto_id)
                echo 'checked';
           ?>
          > {{$ponto->descricao}}<br>

        @endforeach

      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
