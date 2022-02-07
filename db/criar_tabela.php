<div class="titulo">Criar Tabela</div>

<?php

ini_set("display_errors",1);

require_once("conexao.php");

// DDL - Data Definition Lang
$sql = "CREATE TABLE IF NOT EXISTS cadastro (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    nascimento DATE,
    email VARCHAR(100) NOT NULL,
    site VARCHAR(100),
    filhos INT,
    salario FLOAT
)";

$conexao = novaConexao();
$resultado = $conexao -> query($sql);

if ($resultado) {
    echo "Conexação bem sucessida";
} else {
    echo "Erro: " . $conexao -> error;
}

$conexao -> close();

?>