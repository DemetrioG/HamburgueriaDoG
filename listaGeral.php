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
        require_once('header.php');
    ?>
    <div class="conteudo">
        <div class="lista">
            <form method="post">
                <div class="form_busca">
                    <p>Preencha abaixo conforme os filtros desejados.</p>
                    <div class="filtros">
                        <label for="nome" class="label_lista">Nome:</label><br>
                        <input type="text" name="nome" id="input_nome" class="input_lista"><br>
                        <label for="nome" class="label_lista">Descrição:</label><br>
                        <input type="text" name="nome" id="input_descricao" class="input_lista"><br>
                        <label for="nome" class="label_lista">Acompanhamentos:</label><br>
                        <input type="text" name="nome" id="input_acompanhamento" class="input_lista"><br>
                    </div>
                    <table class="tabela_banco">
                        <thead>
                            <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Acompanhamentos</th>  
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script>
        function ajax() {
                var teste = document.getElementById("input_nome").value
                console.log(teste)
                $.ajax({
                    url: "./ajax/listaBanco.php",
                    type: "post",
                    data: {nomeLanche: $("#input_nome").val(), descLanche: $("#input_descricao").val(), acompLanche: $("#input_acompanhamento").val()}, 
                    success: function(data){
                        $("#result").html(data);
                    }
                })
            }
        $(document).ready(ajax())
        document.getElementById("input_nome").addEventListener("keyup", ajax)
        document.getElementById("input_nome").addEventListener("keydown", ajax)       
        document.getElementById("input_descricao").addEventListener("keyup", ajax)
        document.getElementById("input_descricao").addEventListener("keydown", ajax)  
        document.getElementById("input_acompanhamento").addEventListener("keyup", ajax)
        document.getElementById("input_acompanhamento").addEventListener("keydown", ajax)  
    </script>
</body>
</html>