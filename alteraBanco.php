<?php 
    require_once('integraBanco.php');

    $id = $_POST['action'];
    $nome1 = $_POST["input_nome"];
    $descricao1 = $_POST["input_descricao"];
    $acomp = $_POST["input_acomp"];

    if ($id == null || $id == 0) {

        //inser��o no banco de dados
        $sql = "INSERT INTO lanches (nome, descricao, acompanhamento) VALUES ('$nome1', '$descricao1', '$acomp');";

        mysql_query($sql, $conexao) or die ("Query Incorreta: [> ".$sql ." <]<br>".mysql_errno().': '.mysql_error());

        if (mysql_affected_rows() > 0 ) {
            session_start();
            $_SESSION['alert'] = "<script>swal('Dados cadastrados com sucesso!')</script>";
            header ("Location: ./index.php");

        }else {
            echo "<h1>Infelizmente, n�o foi poss�vel cadastrar os dados!</h1>";
        }

    } else {
        //altera��o no banco de dados
        $sql = "UPDATE lanches SET nome = '$nome1', descricao = '$descricao1', acompanhamento = '$acomp' WHERE id = '$id';";

        mysql_query($sql, $conexao) or die ("Query Incorreta: [> ".$sql ." <]<br>".mysql_errno().': '.mysql_error());

        if (mysql_affected_rows() > 0 ) {
            session_start();
            $_SESSION['alert'] = "<script>swal('Dados alterados com sucesso!')</script>";
            header ("Location: ./index.php");
            
        }else {
            session_start();
            $_SESSION['alert'] = "<script>swal('Parece que voc� n�o alterou nenhum dado!')</script>";
            header ("Location: ./cadastro.php?id=$id");
        }
    }
?>