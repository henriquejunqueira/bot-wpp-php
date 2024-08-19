<?php

    require 'verifica_config.php';

?>

<?php

$dinheiro_post = isset($_POST['dinheiro']);
$pix_post = isset($_POST['pix']);
$cartao_post = isset($_POST['cartao']);
$caderneta_post = isset($_POST['caderneta']);
    
    
    $sql = "UPDATE login SET dinheiro = '$dinheiro_post', pix = '$pix_post', cartao = '$cartao_post', caderneta = '$caderneta_post' WHERE email='$email_cliente'";
    $query = mysqli_query($conn, $sql);
    
    try{
        header("Location: config.php?valor=ok");
    }catch (PDOException $error){
        echo "Falha ao tentar alterar senha: " . $error->getMessage();
    }

?>