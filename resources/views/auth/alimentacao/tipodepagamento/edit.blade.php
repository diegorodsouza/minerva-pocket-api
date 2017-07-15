@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('success'))
    <p class="alert-success">
      {{ session('success') }}
    </p>
  @endif

  <form action="{{ url('/edit_tipodepagamento', $tipodepagamento->id) }}" method="post">

    {{method_field('PUT')}}
    {{csrf_field()}}

    <div class="col-lg-3">
      <div class="form-group">
        <label for="descricao">Forma de Pagamento</label>
        <input type="text" name="descricao" placeholder="Digite a forma de pagamento" class="form-control"
               value="{{ $tipodepagamento->descricao }}">
      </div>
      <div class="form-group">
        <input type="submit" value="Salvar" class="btn btn-success">
      </div>
    </div>

  </form>
</div>
@endsection
