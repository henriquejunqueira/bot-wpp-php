<?php require_once 'verifica_pedidos.php'; ?>

<!DOCTYPE html>
<html lang="pt">
  <head>
  <meta name="author" content="Adtile">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <script src="js/responsive-nav.js"></script>
  </head>
  <body>

    <header>
      <a href="index.php" class="logo" data-scroll>DELIVERY</a>
      <?php require_once 'menu.php'; ?>
    </header>

    <section id="home">

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      
      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
      }
      
      form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        margin: 0 auto;
      }
      
      h1 {
        margin-bottom: 10px;
      }
      
      table {
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
      }
      
      th,
      td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
      }
      
      th {
        background-color: #eee;
      }
      
      td:first-child {
        font-weight: bold;
      }
    </style>
  </head>
  <body>
  
  <?php
      $busca_pedidos = "SELECT * FROM pedidos WHERE status = 'aprovado'";
      $resultado_pedidos = mysqli_query($conn, $busca_pedidos);
      $total_pedidos = mysqli_num_rows($resultado_pedidos);
      
      while($dados_pedidos = mysqli_fetch_array($resultado_pedidos)){
          $nome_pedidos = $dados_pedidos['nome_cliente'];
          $telefone_pedidos = $dados_pedidos['telefone'];
          $endereco_pedidos = $dados_pedidos['endereco'];
          $quant_gas_pedidos = $dados_pedidos['quant_gas'];
          $quant_agua_pedidos = $dados_pedidos['quant_agua'];
          $forma_pagamento_pedidos = $dados_pedidos['forma_pagamento'];
          $status_pedidos = $dados_pedidos['status'];
          $data_hora_pedidos = $dados_pedidos['data_hora'];
          $email_painel_pedidos = $dados_pedidos['email_painel'];
  ?>
    <form>
      <h1>Detalhes da venda</h1>
      <table>
      	<tr>
          <td>Cliente:</td>
          <td><?= $nome_pedidos; ?></td>
        </tr>
        <tr>
          <td>Telefone:</td>
          <td><?= $telefone_pedidos; ?></td>
        </tr>
        <tr>
          <td>Endereço:</td>
          <td><?= $endereco_pedidos; ?></td>
        </tr>
        <tr>
          <td>Água Quantidade:</td>
          <td><?= $quant_agua_pedidos; ?></td>
        </tr>
        <tr>
          <td>Gás Quantidade:</td>
          <td><?= $quant_gas_pedidos; ?></td>
        </tr>
        <tr>
          <td>Data:</td>
          <td><?= $data_brasil = date('d/m/Y', strtotime($data_hora_pedidos)); ?></td>
        </tr>
        <tr>
          <td>Hora:</td>
          <td><?= $data_brasil = date('H:i:s', strtotime($data_hora_pedidos)); ?></td>
        </tr>
        <tr>
          <td>Forma de Pagamento:</td>
          <td><?= $forma_pagamento_pedidos; ?></td>
        </tr>
        <tr>
          <td>Valor:</td>
          <td>R$ <?php
            $total_gas = $prod_gas * $quant_gas_pedidos;
            $total_agua = $prod_agua * $quant_agua_pedidos;
            $total_gasto = $total_gas + $total_agua;
            echo $total_gasto;
            
          ?>
          
          
          </td>
        </tr>
      </table>
    </form>
    <br/><br/>
    <?php
        }
    ?>
  </body>
</html>
    </section>

  

    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
  </body>
</html>
