<?php 

    require_once 'conn.php';

?>

<?php 

    // tipos de usuarios cadastrados
    // 1 - usuario comum
    // 2 - administrador
    
    $nome_cliente = $_POST['nome'];
    $senha_cliente = $_POST['senha'];
    $email_cliente = $_POST['email'];
    
    // BUSCA EMAILS DE CLIENTES NO BANCO DE DADOS
    $busca_email = "SELECT * FROM login WHERE email = '$email_cliente'";
    $resultado_busca = mysqli_query($conn, $busca_email);
    $total_clientes = mysqli_num_rows($resultado_busca);
    
    // VERIFICA SE EMAIL JÀ ESTÀ CADASTRADO
    if($total_clientes > 0){
        //echo "<meta http-equiv='refresh' content='0;url=email_ja_cadastrado.php'>";
        header("Location: email_ja_cadastrado.php");
    }else{
        $sql = "INSERT INTO login (nome, senha, email, tipo) VALUES ('$nome_cliente', '$senha_cliente', '$email_cliente', '1') ";
        $query = mysqli_query($conn, $sql);
        
        try{
            //echo "<meta http-equiv='refresh' content='0;url=sucesso.php'>";
            header("Location: sucesso.php");
        }catch(PDOException $error){
            //echo "Erro ao tentar cadastrar!" . $error->getMessage();
            header("Location: erro_cadastro.php");
        }
        
    }

?>