<div class="titulo">Inserir Registro #01</div>

<?php

require_once("conexao.php");

$sql = "INSERT INTO cadastro 
(nome, nascimento, email, site, filhos, salario)
VALUES (
    'Marian Edgington',
    '1994-03-29',
    'marianjedgington@gustr.com',
    'https://marianedgington.com.eu',
    3,
    24287.32
)";

$conexao = novaConexao();
$resultado = $conexao -> query($sql);

if ($resultado) {
    echo "Conexão Bem Sucessida";
} else {
    echo "Erro: " . $conexao -> error;
}

$conexao -> close();

?>