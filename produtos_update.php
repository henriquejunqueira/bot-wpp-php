<?php require_once 'verifica_sessao.php'; ?>

<?php

    $gas_post = $_POST['gas'];
    $agua_post = $_POST['agua'];
    
    $sql = "UPDATE login SET prod_gas = '$gas_post', prod_agua = '$agua_post' WHERE email = '$email_cliente'";
    $query = mysqli_query($conn, $sql);
    
    try{
        header("Location: produtos.php?valor=ok");
    }catch (PDOException $error){
        echo "Falha ao tentar alterar produto: " . $error->getMessage();
    }
    

?>