@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <h3>Centros e Pontos de Ônibus</h3>
                  <ul>
                    <li><a href="{{ route('CentroPonto') }}"> Gerir Centros e Pontos de Ônibus</a> - <div class="aviso">Necessário antes de criar qualquer outro item</div></li>
                  </ul>
                  <h3>Alimentação</h3>
                  <ul>
                    <li><a href="{{ route('TipoDePagamento') }}"> Gerir Formas de Pagamento</a>> - <div class="aviso">Necessário antes de criar um local de alimentação</div></li>
                    <li><a href="{{ route('TipoDeComida') }}"> Gerir Tipos de Serviço de Comida</a>> - <div class="aviso">Necessário antes de criar um local de alimentação</div></li>
                    <li><a href="{{ route('Alimentacao') }}"> Gerir Locais de Alimentação</a></li>
                  </ul>
                  <h3>Acadêmico</h3>
                  <ul>
                    <li><a href="{{ route('TipoDeAcademico') }}"> Gerir Tipos de Serviço Acadêmico</a>> - <div class="aviso">Necessário antes de criar um serviço acadêmico</div></li>
                    <li><a href="{{ route('Academico') }}"> Gerir Serviços Acadêmicos</a></li>
                  </ul>
                  <h3>Transporte</h3>
                  <ul>
                    <li><a href="{{ route('Transporte') }}"> Gerir Linhas de Ônibus</a></li>
                  </ul>
                  <h3>Serviços</h3>
                  <ul>
                    <li><a href="{{ route('ServicoBanco') }}"> Gerir Caixas Eletrônicos e Agências Bancárias</a></li>
                    <li><a href="{{ route('ServicoComercio') }}"> Gerir Estabelecimentos Comercias</a></li>
                    <li><a href="{{ route('ServicoXeroxGrafica') }}"> Gerir Xerox e Gráficas</a></li>
                    <li><a href="{{ route('ServicoOutro') }}"> Gerir Outros Serviços</a></li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
