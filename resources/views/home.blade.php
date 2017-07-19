@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <h2>Centros e Pontos de Ônibus</h2>
                  <ul>
                    <li><a href="{{ route('CentroPonto') }}"> Gerir Centros e Pontos de Ônibus</a></li>
                  </ul>
                  <h2>Alimentação></h2>
                  <ul>
                    <li><a href="{{ route('TipoDePagamento') }}"> Gerir Formas de Pagamento</a></li>
                    <li><a href="{{ route('TipoDeComida') }}"> Gerir Tipos de Serviço de Comida</a></li>
                    <li><a href="{{ route('Alimentacao') }}"> Gerir Locais de Alimentação</a></li>
                  </ul>
                  <h2>Acadêmico</h2>
                  <ul>
                    <li><a href="{{ route('TipoDeAcademico') }}"> Gerir Tipos de Serviço Acadêmico</a></li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
