@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('UpdateTipoDeComida', $tipodecomida->id) }}" method="post">

    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="col-lg-3">
      <div class="form-group">
        <label for="descricao">Tipo de Serviço de Comida</label>
        <input type="text" name="descricao" placeholder="Digite o tipo de comida" class="form-control"
               value="{{ $tipodecomida->descricao }}">
      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
