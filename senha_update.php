<?php

    require_once 'verifica_sessao.php';

?>

<?php

    $senha_post = $_POST['senha'];
    $sql = "UPDATE login SET senha = '$senha_post' WHERE email='$email_cliente'";
    $query = mysqli_query($conn, $sql);
    
    try{
        header("Location: config.php?senha=ok");
    }catch (PDOException $error){
        echo "Falha ao tentar alterar senha: " . $error->getMessage();
    }

?>