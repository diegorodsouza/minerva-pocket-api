@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ route('UpdateTipoDeAcademico', $tipodeacademico->id) }}" method="post">

    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="col-lg-offset-3 col-lg-6">
      <div class="form-group">
        <label for="descricao">Tipo de Serviço Acadêmico</label>
        <input type="text" required name="descricao" placeholder="Digite o tipo de serviço acadêmico" class="form-control"
               value="{{ $tipodeacademico->descricao }}">
      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
