<!DOCTYPE html>
<html lang="pt" >
<head>
  <meta charset="UTF-8">
  <title>DELIVERY</title>

  

    <meta name="author" content="Adtile">
    <meta name="viewport" content="width=device-width,initial-scale=1">
   
  <link rel="stylesheet" href="style.css">

<div class="login-page">
  <div class="form">
    <div align="center"><img src="insta.png"  height="150" width="150"></div>
    <br>
    <form class="login-form" onsubmit="return verificaSenhas()" action="cadastro2.php" method="POST">
      <input type="text" id="nome" name="nome" placeholder="NOME"/>
      <input type="password" id="senha" name="senha" placeholder="SENHA" required>
  <input type="password" id="confirmar_senha" placeholder="CONFIRMAR SENHA" name="confirmar_senha" required>
      <input type="text" id="email" name="email" placeholder="EMAIL"/>
      <button>Criar Conta</button>
      <p class="message">Já é registrado <a href="login.php">entre aqui</a></p>
    </form>
   
<script>
  function verificaSenhas() {
    var senha = document.getElementById("senha").value;
    var confirmar_senha = document.getElementById("confirmar_senha").value;

    if (senha != confirmar_senha) {
      alert("As senhas não são iguais!");
      return false;
    }

    return true;
  }
</script>
  </div>
</div>