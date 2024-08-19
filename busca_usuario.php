<?php

//print_r($_REQUEST);

$nome_usuario = $_POST['nome_usuario'];
$opcao_busca = $_POST['opcao_busca'];

$busca_usuarios = "SELECT * FROM login WHERE nome LIKE '%$nome_usuario%'";
$resultado_busca = mysqli_query($conn, $busca_usuarios);
$total_clientes = mysqli_num_rows($resultado_busca);

while ($dados_usuario = mysqli_fetch_array($resultado_busca)){
    $id_cliente = $dados_usuario['id'];
    $email_cliente = $dados_usuario['email'];
    $senha_cliente = $dados_usuario['senha'];
    $nome_cliente = $dados_usuario['nome'];
    $tipo_cliente = $dados_usuario['tipo'];
    $status_cliente = $dados_usuario['status'];
    
    ?>


<!-- Formulário de habilitar e desabilitar -->
<form method="post" action="usuario_update.php">
  <h2>Usuário encontrado: <?= "<strong>$total_clientes</strong>"; ?></h2>
  <p>Nome: <?= $nome_cliente; ?></p>
  <p>Email: <?= $email_cliente; ?></p>
  <input name="id_usuario" type="hidden" id="id_usuario" value='<?= "$id_cliente"; ?>'>
  <p>Status: Ativo</p>
  <label>
    <input type="radio" name="status" value="ativo" <?php if($status_cliente == 'ativo'){echo "checked";} ?>> Ativar
  </label>
  <label>
    <input type="radio" name="status" value="inativo" <?php if($status_cliente == 'inativo'){echo "checked";} ?>> Desativar
  </label>
  <input type="submit" value="Salvar">
</form>
<br />

<?php }?>