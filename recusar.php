<?php require_once 'verifica_sessao.php'; ?>


<?php

$id_pedido = $_POST['id_pedido'];

$sql = "DELETE FROM pedidos WHERE id = '$id_pedido'";
$query = mysqli_query($conn, $sql);

try{
    header("Location: pedidos.php");
}catch (PDOException $error){
    echo "Falha ao tentar alterar pedido: " . $error->getMessage();
}


?>