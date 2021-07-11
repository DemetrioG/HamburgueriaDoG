<?php 
    require_once('integraBanco.php')
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./media/hamburger-emoji.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Hamburgueria do G - Cadastro</title>
</head>
<body>
    <?php 
        require_once('header.php');

        //importando alerta personalizado
        require_once('alert.html');
    ?>
    <div class="conteudo">    
        <?php 
            //verifica se o parametro get esta setado   
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                
                $sql = "SELECT * FROM lanches WHERE id='$id';";
                $listar = mysql_query($sql, $conexao) or die ("Query Incorreta: [> ".$sql ." <]<br>".mysql_errno().': '.mysql_error());
                $dados = mysql_fetch_assoc($listar);

                echo "<p>Preencha abaixo, os dados a serem alterados!</p>";
            }else {
                echo "<p>Preencha abaixo, os dados a serem cadastrados!</p>";
            }

            //alerta de dados alterados
            session_start();
            if (isset($_SESSION['alert'])) {
                echo $_SESSION['alert'];
            }
            unset($_SESSION['alert']);
        ?>
        <div class="form">
            <form action="alteraBanco.php" method="POST">
                <div class="input_lanche">
                    <input type="hidden" name="action" value="<?=$id?>">
                    <label for="nome_label" class="label">Nome do Lanche:</label><br>
                    <input type="text" class="input" id="nome_label" name="input_nome" required value="<?=$dados['nome']?>">
                </div>
                <div class="input_lanche">             
                    <label for="descricao_label" class="label">Descrição:</label><br>
                    <input type="text" class="input" id="descricao_label" name="input_descricao" required value="<?=$dados['descricao']?>">
                </div>
                <div class="input_lanche">
                    <label for="acomp_label" class="label">Acompanhamentos:</label><br>
                    <input type="text" class="input" id="acomp_label" name="input_acomp" required value="<?=$dados['acompanhamento']?>">
                </div>          
                <button type="submit" name="verificar" class="botao_cadastro" id="cadastro_form">Cadastrar</button>            
            </form>
        </div>
        <div id="resultado"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script>
        document.getElementById("nome_label").addEventListener("blur", () => {
            $.ajax({
                url: "./ajax/buscaLanche.php",
                method: "GET",
                data: {nomeLanche : $("#nome_label").val()},
                success: function (data) {
                    if (data == 1) {
                        swal('Este nome já está cadastrado!')
                        document.getElementById("cadastro_form").setAttribute("disabled", "disabled")
                    }else {
                        document.getElementById("cadastro_form").removeAttribute("disabled")
                    }
                }
            })
        })
    </script>
</body>
</html>
