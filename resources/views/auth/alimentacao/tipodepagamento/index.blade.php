<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style media="screen">
          ._content{
            width: 700px;
            display: flex;
            justify-content: center;
            margin-top: 100px;
          }
        </style>
    </head>
    <body>

      <div class="container _content">
        <h1>Formas de Pagamento</h1>
        <p>
          <a class="btn btn-success" href="{{url('/create_tipodepagamento')}}">Adicionar Forma de Pagamento</a>
        </p>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Descrição</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>À vista</td>
              <td>
                <input type="button" name="" value="Deletar" class="btn btn-danger">
                <input type="button" name="" value="Editar" class="btn btn-primary">
              </td>
            </tr>
          </tbody>
        </table>

      </div>

    </body>
</html>
