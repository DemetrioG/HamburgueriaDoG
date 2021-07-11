<?php 
    //Abre conexao com o banco e seleciona a database
    $conexao = mysql_connect('db.trator.w2o', 'root', 'root');
    if (!$conexao) {
        die('Não foi possível conectar: '.mysql_error());
    }
    
    $seleciona_db = mysql_select_db('CADASTRO_LANCHES', $conexao);
    if (!$seleciona_db) {
        die('Algo deu errado: '.mysql_error());
    }
    unset($seleciona_db);
?>