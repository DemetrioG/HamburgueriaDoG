<?php 
    require_once('../integraBanco.php');

    //traz os dados dos inputs do Ajax
    $nome = $_POST["nomeLanche"];
    $descricao = $_POST["descLanche"];
    $acomp = $_POST["acompLanche"];


    //se os inputs estiverem em branco, lista todos os dados do banco
    if ($nome == "" && $descricao == "" && $acomp == "") {
        $listar = mysql_query("SELECT * FROM lanches;", $conexao);
    } else {

        //se o input nome não estiver em branco, fica mandando requisições filtrando pelo nome
        if ($nome != "" && $descricao == "" && $acomp == "") {
            $listar = mysql_query("SELECT * FROM lanches WHERE nome LIKE '%$nome%';", $conexao);

        } elseif ($nome != "" && $descricao != "" && $acomp == "") {
            $listar = mysql_query("SELECT * FROM lanches WHERE nome LIKE '%$nome%' && descricao LIKE '%$descricao%';", $conexao);

        } elseif ($nome != "" && $descricao != "" && $acomp != "") {
            $listar = mysql_query("SELECT * FROM lanches WHERE nome LIKE '%$nome%' && descricao LIKE '%$descricao%' && acompanhamento LIKE '%$acomp%';", $conexao);

        } elseif ($descricao != "" && $nome == "" && $acomp == "" ) {
            $listar = mysql_query("SELECT * FROM lanches WHERE descricao LIKE '%$descricao%';", $conexao);

        }   elseif ($acomp != "" && $nome == "" && $descricao == "") {
            $listar = mysql_query("SELECT * FROM lanches WHERE acompanhamento LIKE '%$acomp%';", $conexao);

        }  elseif ($acomp != "" && $nome != "" && $descricao == "") {
            $listar = mysql_query("SELECT * FROM lanches WHERE acompanhamento LIKE '%$acomp%' && nome LIKE '%$nome%';", $conexao);
        } elseif ($acomp != "" && $nome == "" && $descricao != "") {
            $listar = mysql_query("SELECT * FROM lanches WHERE acompanhamento LIKE '%$acomp%' && descricao LIKE '%$descricao%';", $conexao);
        }

    }

    //monta a tabela com os dados do banco
    while ($arquivo = mysql_fetch_assoc($listar)) {
        $list_nome = ucfirst($arquivo['nome']);
        $list_desc = ucfirst($arquivo['descricao']);
        $list_acomp = ucfirst($arquivo['acompanhamento']);
        echo "<tr>
                <td>$list_nome</td>
                <td>$list_desc</td>
                <td>$list_acomp</td>
            </tr>";
        
    }
    $total = mysql_num_rows($listar);
    echo "<tr>";
        if ($total == 1) {
            echo "<td colspan='3' id='listagem'>Foi encontrado o total de $total registro</td>";
        }else {
            echo "<td colspan='3' id='listagem'>Foram encontrados o total de $total registros</td>";
        }

    $arquivo = mysql_fetch_assoc($listar);
    echo "<p>$arquivo</p>";
?>