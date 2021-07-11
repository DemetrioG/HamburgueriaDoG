<?php 
    require_once('./integraBanco.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM lanches WHERE id=$id;";

    mysql_query($sql, $conexao) or die ("Query Incorreta: [> ".$sql ." <]<br>".mysql_errno().': '.mysql_error());

    if (mysql_affected_rows() > 0 ) {
        session_start();
        $_SESSION['alert'] = "<script>swal('Dados excluídos com sucesso!')</script>";
        header ("Location: ./index.php");
    }else {
        echo "<h1>Infelizmente, não foi possível excluir os dados!</h1>";
    }
?>