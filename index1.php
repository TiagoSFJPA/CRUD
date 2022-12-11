<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de alunos e notas</title>
</head>
<body>

    


<?php
    $pdo = new PDO('mysql:host=localhost;dbname=aulaprogweb', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_GET['delete'])){
        $cod_aluno1 = (int)$_GET['delete'];
        $pdo->exec("DELETE FROM `tab_aluno1` WHERE `cod_aluno1` = $cod_aluno1");
        echo "<h2>Usuário com id = $cod_aluno1 excluido com secesso!</h2>";
    }

    if (isset($_POST['nome'])) {
       $sql = $pdo->prepare("INSERT INTO `tab_aluno1` VALUES (null,?,?,?,?,?)");
       $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email'],));
       echo "<h2>Cadastro realizado com sucesso!</h2>";
    }


?>

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<form method="POST">
    <legend>Insira os dados abaixo.</legend>
    <fieldset>
       <div>
            Nome: <input type="text" class="form-control"
            name="nome">
       </div> 
       <div>
            CPF: <input type="text" class="form-control"
            name="cpf">
       </div> 
       <div>
            Email: <input type="text" class="form-control"
            name="email">
       </div>
       <div>
           <input type="submit" class="btn btn-primary" value="Enviar">
           <input type="reset" class="btn btn-primary" value="Limpa Dados">
       </div>
    </fieldset>
</form>



 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
     </script>
 <?php
    $sql = $pdo->prepare("SELECT * FROM tab_aluno1");
    $sql->execute();
    $alunos = $sql->fetchAll();
    echo "<table class='table table-striped table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col' colspan='2' align='center'>Ações</th>";
    echo "<th scope='col'>Nome</th>";
    echo "<th scope='col'>CPF</th>";
    echo "<th scope='col'>Email</th>";
    echo "</tr>";
    echo "</thead>";
    foreach ($alunos as $aluno) {
        echo "<tr>";
        echo '<td align="center">
            <a href="?delete=' . $aluno['cod_aluno1'] . '">( X )</a>
         </td>';
        echo '<td align="center">
            <a href="alterar.php?cod_aluno1=' . $aluno['cod_aluno1'] . '">( Alterar )</a>
         </td>';
        echo "<td>" . $aluno['nome'] . "</td>";
        echo "<td>" . $aluno['cpf'] . "</td>";
        echo "<td>" . $aluno['email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>
</html>