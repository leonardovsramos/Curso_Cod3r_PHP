<div class="titulo">PDO: Inserir</div>

<?php

require_once "conexao_pdo.php";

$sql = "INSERT INTO cadastro 
(nome, nascimento, email, site, filhos, salario)
VALUES (
    'Guilherme Filho',
    '1998-07-21',
    'guidagalera@gmail.com',
    'https://guidagalera.com.br',
    0,
    3000
)";

$conexao = novaConexao();


// echo "<pre>";
// print_r(get_class_methods($conexao));
// echo "</pre>";

if ($conexao -> exec($sql)) {
    $id = $conexao -> lastInsertId();
    echo "Novo cadastro com id $id.";
} else {
    echo $conexao -> errorCode() . "<br>";
    echo "<pre>";
    print_r($conexao -> errorInfo());
    echo "</pre>";
}

$conexao -> close();
?>