<?php 
    
    if (isset($_GET['nomeLanche'])) {
        require_once("../integraBanco.php");
        $nome = $_GET['nomeLanche'];
        
        $rs = mysql_query("SELECT nome FROM lanches WHERE nome = '$nome';", $conexao);
        if (mysql_num_rows($rs) > 0) {
            echo 1;
        }
        else{
            echo 0;
        }
    }
    else {
        die();
    }
?>