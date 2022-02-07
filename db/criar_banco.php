<div class="titulo">Criar Banco de Dados</div>

<?php

require_once "conexao.php";

$conexao = novaConexao(null);

$sql = "CREATE DATABASE IF NOT EXISTS curso_php";

$resultado = $conexao -> query($sql);

if ($resultado) {
    echo "Conexação bem sucessida";
} else {
    echo "Erro: " . $conexao -> error;
}

$conexao -> close();

?>