<?php

    $dsn = 'localhost';
    $dbuser = 'root';
    $dbpass = 'ti_2henrique';
    $dbname = 'bot';
    
    try{
        $conn = mysqli_connect($dsn, $dbuser, $dbpass, $dbname);
    }catch(PDOException $error){
        echo "Falha de conexão" . $error->getMessage();
    }