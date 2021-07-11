<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./media/hamburger-emoji.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Hamburgueria do G</title>
</head>
<body>
    <?php 
        //importando cabeçalho
        require_once('header.php');
        //importando alert customizado
        require_once('alert.html');

        //alerta de dados alterados
        session_start();
        if (isset($_SESSION['alert'])) {
            echo $_SESSION['alert'];
        }
        unset($_SESSION['alert']);
    ?>
    <div class="conteudo">
        <?php 
          require_once('integraBanco.php');
          $sql = "SELECT * FROM lanches;";
            $listar = mysql_query($sql, $conexao) or die ("Query Incorreta: [> ".$sql ." <]<br>".mysql_errno().': '.mysql_error());

          if (mysql_num_rows($listar) == 0) {
              echo "<p>Não há lanches cadastrados no momento, cadastre-os no botão abaixo!</p>";
          }else {
              echo "<p>Segue abaixo, os lanches cadastrados até o momento.</p>";
              echo "<div class='lista'>";
               
                while ($row = mysql_fetch_assoc($listar)) {                   
                    echo "<div class='item'>";
                    echo "<a class='botao' href='./excluirBanco.php?id=$row[id]'>Excluir</a>"."<a id='alterar' class='botao' href='./cadastro.php?id=$row[id]'>Alterar</a>";
                    $list_nome = ucfirst($row['nome']);
                    $list_desc = ucfirst($row['descricao']);
                    $list_acomp = ucfirst($row['acompanhamento']);
                    echo "<h2>$list_nome</h2><br>";
                    echo "<h3>$list_desc</h3><br>";
                    echo "<p>$list_acomp</p><br>";
                    echo "</div>";
                }
                echo "</div>";
          }        
        ?>            
        <div class="cadastro">
                <p>Deseja cadastrar algum novo lanche?</p>
                <a href="./cadastro.php" class="botao_cadastro" id="btn_cadastro">Cadastro</a>
        </div>
        <div class="cadastro">
                <p>Deseja consultar a lista de lanches?</p>
                <a href="./listaGeral.php" class="botao_cadastro" id="btn_cadastro">Consultar</a>
        </div>
    </div>
</body>
</html>
