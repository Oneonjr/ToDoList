<?php 
    // configurações de coneção com banco de dados
    $host = "localhost"; // host do banco de Dados.
    $dbname = "todolist"; // nome do banco de Dados.
    $username = "root";// nome de USER do banco de Dados.
    $password = ""; // Senha do banco de Dados.

    // Conexão com o banco de dados usando a extensão PDO

    try {
        $bd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);
        //habilitar exceções para erros de banco de dados.
        $bd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: ".$e->getMessage());
    }

?>