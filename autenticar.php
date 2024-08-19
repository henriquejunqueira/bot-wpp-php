<?php

   session_start();
   require_once 'conn.php';
   
   $email_cliente = $_POST['email'];
   $senha_cliente = $_POST['senha'];
   
   $busca_email_senha = "SELECT * FROM login WHERE email = '$email_cliente' AND senha = '$senha_cliente'";
   $resultado_busca = mysqli_query($conn, $busca_email_senha);
   $total_clientes = mysqli_num_rows($resultado_busca);
   
   if($total_clientes == 1){
       $_SESSION['email'] = $email_cliente;
       $_SESSION['senha'] = $senha_cliente;
       
       header("Location: index.php");
   }else{
       header("Location: login_falhou.php");
   }

?>

