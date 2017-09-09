@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                  <h3 class="aviso">Centros e Pontos de Ônibus</h3>
                  <ul>
                    <li><a href="{{ route('CentroPonto') }}"> Gerir Centros e Pontos de Ônibus</a> - <span>{{$centros}} Centros e {{$pontos}} Pontos cadastrados</span>
                      <p class="aviso">Necessário antes de criar qualquer outro item</p></li>
                  </ul>

<style>

#overlay {
    position: fixed; /* Sit on top of the page content */
    display: block; /* Show by default */
    background: rgba(0, 0, 0, 0.21);
    z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
    pointer-events: none;
}
</style>

<script>

var o = function off() {
  if ({{$centros}} > 0 )
    document.getElementById("overlay").style.display = "none";
} 

</script>


                  <div id="overlay">
                  <div id="text">Cadastre Centros e Pontos de Õnibus antes</div>
  
                    <h3>Alimentação</h3>
                    <ul>
                      <li><a href="{{ route('TipoDePagamento') }}"> Gerir Formas de Pagamento</a> - <span>{{$tiposdepagamentos}} Tipos de pagamentos cadastrados</span>
                        <p class="aviso">Necessário antes de criar um local de alimentação</p></li>

                      <li><a href="{{ route('TipoDeComida') }}"> Gerir Tipos de Serviço de Comida</a> - <span>{{$tiposdecomidas}} Tipos de serviços de comida cadastrados</span>
                        <p class="aviso">Necessário antes de criar um local de alimentação</p></li>

                      <li><a href="{{ route('Alimentacao') }}"> Gerir Locais de Alimentação</a> - <span>{{$alimentacao}} Locais de alimentação cadastrados</span></li>
                    </ul>

                    <h3>Acadêmico</h3>
                    <ul>
                      <!-- <li> -->
                        <!-- <a href="{{ route('TipoDeAcademico') }}"> Gerir Tipos de Serviço Acadêmico</a> - <span>{{$tiposdeacademicos}} Tipos de serviços academicos cadastrados</span>
                        <p class="aviso">Necessário antes de criar um serviço acadêmico</p></li> -->
                      <li><a href="{{ route('Academico') }}"> Gerir Serviços Acadêmicos</a> - <span>{{$academicos}} Serviços acadêmicos cadastrados</span></li>
                    </ul>

                    <h3>Transporte</h3>
                    <ul>
                      <li><a href="{{ route('Transporte') }}"> Gerir Linhas de Ônibus</a> - <span>{{$transportes}} Linhas de ônibus cadastradas</span></li>
                    </ul>

                    <h3>Serviços</h3>
                    <ul>
                      <li><a href="{{ route('ServicoBanco') }}"> Gerir Caixas Eletrônicos e Agências Bancárias</a> - <span>{{$caixas}} Caixas Eletrônicos e {{$agencias}} Agências cadastradas</span></li>
                      <li><a href="{{ route('ServicoComercio') }}"> Gerir Estabelecimentos Comercias</a> - <span>{{$comercios}} Estabelecimentos comerciais cadastradas</span></li>
                      <li><a href="{{ route('ServicoXeroxGrafica') }}"> Gerir Xerox e Gráficas</a> - <span>{{$xerox_graficas}} Gráficas e Xerox cadastradas</span></li>
                      <li><a href="{{ route('ServicoOutro') }}"> Gerir Outros Serviços</a> - <span>{{$outros}} Serviços diversos cadastradas</span></li>
                    </ul>

                    <h3>Infraestrutura</h3>
                    <ul>
                      <li><a href="{{ route('Infraestrutura') }}"> Gerir Infraestruturas</a> - <span>{{$infras}} Itens de Infraestrutura Cadastrados</span></li>
                    </ul>

                  </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
