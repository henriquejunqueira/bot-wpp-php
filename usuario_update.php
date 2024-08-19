<?php require_once 'verifica_admin.php'; ?>

<?php

    $id_usuario = $_POST['id_usuario'];
    $status = $_POST['status'];
    
    $sql = "UPDATE login SET status = '$status' WHERE id='$id_usuario'";
    $query = mysqli_query($conn, $sql);
    
    try{
        header("Location: admin.php?valor=ok");
    }catch (PDOException $error){
        echo "Falha ao tentar alterar senha: " . $error->getMessage();
    }
    

?>