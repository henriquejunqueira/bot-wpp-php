<?php

session_start();
require_once 'conn.php';
error_reporting(0);
ini_set("display_errors", 0);

if($_SESSION['email'] == True){
    $email_cliente = $_SESSION['email'];
    $busca_email = "SELECT * FROM login WHERE email = '$email_cliente'";
    $resultado_busca = mysqli_query($conn, $busca_email);
    $total_clientes = mysqli_num_rows($resultado_busca);
    
    while($dados_usuario = mysqli_fetch_array($resultado_busca)){
        $email_cliente = $dados_usuario['email'];
        $senha_cliente = $dados_usuario['senha'];
        $nome_cliente = $dados_usuario['nome'];
        $tipo_cliente = $dados_usuario['tipo'];
        $dinheiro_cliente = $dados_usuario['dinheiro'];
        $pix_cliente = $dados_usuario['pix'];
        $cartao_cliente = $dados_usuario['cartao'];
        $caderneta_cliente = $dados_usuario['caderneta'];
    }
    
    
    
}else{
    //header("Location: login.php");
    ?>

	<script type="text/javascript">
		window.location="login.php";
	</script>

<?php
}
?>