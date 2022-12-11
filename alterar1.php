<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=aulaprogweb', 'root', '');

if (isset($_GET['cod_aluno1'])) {
    $cod_aluno1 = (int)$_GET['cod_aluno1'];
    //mount form whit data
    $sql = $pdo->prepare("SELECT * FROM tab_aluno1 WHERE cod_aluno1 = $cod_aluno1");
    $sql->execute();
    $alunos = $sql->fetchAll();

    //montar formulário com os dados dos alunos
    foreach ($alunos as $aluno) {
        echo "<form method='POST'>";
        echo "<legend>Insira os dados abaixo</legend>";
        echo "<fieldset>";
        echo "<div>";
        echo "Nome: <input type='text' class='form-control' name='nome' value='" . $aluno['nome'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "Matrícula: <input type='text' class='form-control' name='matricula' value='" . $aluno['cpf'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "Nota 1: <input type='text' class='form-control' name='nota1' value='" . $aluno['email'] . "'>";
        echo "</div>";
        echo "<div>";        
        echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
        echo "<input type='reset' class='btn btn-primary' value='Limpar Dados'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
    }

    
}

if (isset($_POST['nome'])) {
 
    $sql = $pdo->prepare("UPDATE tab_aluno1 SET nome = ?, cpf = ?, email = ?, WHERE cod_aluno1 = $cod_aluno1");
    $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email']));
    echo "<h1>Usuário com id = $cod_aluno1 alterado com sucesso!</h1>";
    //fazer botao para voltar para a pagina de listagem
    echo "<a href='index.php'>Voltar</a>";

    //echo "<h1>Alterado com sucesso!</h1>";
}