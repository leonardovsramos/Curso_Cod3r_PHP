<div class="titulo">Excluir Registros #01</div>

<?php

require_once("conexao.php");

$sql = "DELETE FROM cadastro WHERE id = 2";

$conexao = novaConexao();
$resultado = $conexao -> query($sql);

if ($resultado) {
    echo "Conexão Bem Sucedida!";
} else {
    echo "Erro: " . $conexao -> error;
}

$conexao -> close();

?>