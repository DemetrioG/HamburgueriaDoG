<h1 style="
    text-align: center;
    height: 7;
    margin-top: 150;
    margin-bottom:70;
"> Consulta de formações </h1>

<body>
<form method="post" >
    <div class="col-lg-3">
        <div class="form-group">
            <label for="NOME">Nome: </label>
            <input class="form-control" id="NOME" placeholder="Nome do colaborador" name="NOME">
        </div>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 24;">Buscar</button>
</form>
<!--Filtro de busca-->
<?php

$nome = $_POST['NOME'];

if($nome!=""){
    $lnk = mysql_connect('localhost','root','') or die(mysql_error()) or die ('Nao foi possível conectar ao MySql: ' . mysql_error());
    mysql_select_db('db_formacao') or die ('Nao foi possível ao banco de dados selecionado no MySql: ' . mysql_error());  

    $sql1 = "SELECT * from formacoes where locate('$nome',NOME)>0 order by NOME asc";
    $query = mysql_query($sql1) or die(mysql_error());

    if(@mysql_num_rows($query) > 0){ // Verifica se o SQL retornou algum registro
?>
Encontrado registros com <?php echo $nome ?>:
<br><br>
<?php
    while($dados = mysql_fetch_array($query)){ //loop para exibir na página os registros que foram encontrados
?>
<?php echo $dados['nome']?>
<br>
<?php
        }
        echo "<br>";
    }else{
?>
Nada encontrado com <?php echo $nome ?>
<br><br>
<?php
    }
    mysql_close($lnk);
}
?>

<!--Tabela com as buscas-->
<?php
//Conexão e consulta ao Mysql
mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('db_formacao') or die(mysql_error());
$qry = mysql_query("select * from formacoes");

 $nome = $_POST['NOME'];
 $sql = (" SELECT * FROM formacoes WHERE NOME LIKE '%".$nome."%'");
//Pegando os nomes dos campos
$num_fields = mysql_num_fields($qry);//Obtém o número de campos do resultado

for($i = 0;$i<$num_fields; $i++){//Pega o nome dos campos
    $fields[] = mysql_field_name($qry,$i);
}

//Montando o cabeçalho da tabela
$table = '<table class="table table-hover table-inverse" style="margin-top:50;background-color: #37444a; color:lightgrey;"> <tr>';

for($i = 0;$i < $num_fields; $i++){
    $table .= '<th>'.$fields[$i].'</th>';
}

//Montando o corpo da tabela
$table .= '<tbody style="
    background-color: #86979e;
    color: #37444a;    
">';
while($r = mysql_fetch_array($qry)){
    $table .= '<tr>';
    for($i = 0;$i < $num_fields; $i++){
        $table .= '<td>'.$r[$fields[$i]].'</td>';
    }

    // Adicionando botão de exclusão
    $table .= '<td><form action="banco/deleteF.php" method="post">'; 
    $table .= '<input type="hidden" name="ID" value="'.$r['ID'].'">';
    $table .= '<button  class="btn btn-danger">Excluir</button>'; 
    $table .= '</form></td>';
}

//Finalizando a tabela
$table .= '</tbody></table>';

//Imprimindo a tabela
echo $table;

?>