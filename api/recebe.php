<?php

    require_once '../conn.php';
    
    $numero_get = $_GET['telefone'];
    $usuario_get = $_GET['usuario'];
    $msg_usuario = $_GET['msg'];
    
    // Define o formato de data e hora
    date_default_timezone_set('America/Sao_Paulo');
    $novo = time();
    $data_hora = date('Y-m-d H:i:s', $novo); // o padrão será o americano por enquanto
    //echo $data_hora;
    
    // Função para identificar se está sendo recebido um número
    function ehNumero($texto){
        return is_numeric($texto);
    }
    
    // Função para deixar a primeira letra maiúscula
    function primeiraLetraMaiuscula($texto){
        $primeiraLetra = mb_strtoupper(mb_substr($texto, 0, 1));
        $restante = mb_strtolower(mb_substr($texto, 1));
        
        return $primeiraLetra . $restante;
    }
    
    //echo primeiraLetraMaiuscula($msg_usuario);
    
    /*if(!ehNumero($msg_usuario)){
        echo "a mensagem <strong>$msg_usuario</strong> NÃO é número";
    }*/
    
    $busca_cliente = "SELECT * FROM cliente WHERE telefone = '$numero_get' AND email_painel = '$usuario_get'";
    $cliente = mysqli_query($conn, $busca_cliente);
    $total_cliente = mysqli_num_rows($cliente);
    
    while($dados_cliente = mysqli_fetch_array($cliente)){
        $id_cliente = $dados_cliente['id'];
        $telefone_cliente = $dados_cliente['telefone'];
        $nome_cliente = $dados_cliente['nome'];
        $endereco_cliente = $dados_cliente['endereco'];
        $email_painel_cliente = $dados_cliente['email_painel'];
        $situacao_cliente = $dados_cliente['situacao'];
    }
    
    if($total_cliente == 0){
        $sql = "INSERT INTO cliente (telefone, email_painel) VALUES ('$numero_get', '$usuario_get')";
        $query = mysqli_query($conn, $sql);
        
        if($query){
            $msg = 'Para começar, me diga seu nome 😊';
            $sql = "INSERT INTO envios (telefone, msg, status, usuario) VALUES ('$numero_get', '$msg', '1', '$usuario_get')";
            $query = mysqli_query($conn, $sql);
        }
    }
    

?>